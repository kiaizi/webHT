<?php
include_once("config.php");
include_once(DIR_COMMON . "global_header.php");

define(ID, $_REQUEST['id']);


$sql = "select * from " . TB_MEMBER . " as member ";
$sql .= " where ";
$sql .= " id='" . ID . "' ";
$sql .= " and disabled <>'" . DISABLED_DELETE . "' ";
$edit_data = $G_DB_CONNECT->query_first($sql);

if (ID > 0 && $edit_data['id'] == '') {
    exit(WARN_ACCESS_DENIED);
}


/////////////////////////////////////////////
// upload file
/////////////////////////////////////////////
$arr_member_photo_language_id = getRequestVar("member_photo_language_id", '');
$arr_member_photo_sort_order = getRequestVar("member_photo_sort_order", '');
$arr_member_photo_disabled = getRequestVar("member_photo_disabled", '');
$arr_member_photo_img_old_path = getRequestVar("member_photo_img_old_path", '');
if ($arr_member_photo_disabled != '' && ID > 0) {

    $member_id = ID;
    //$member_code = getDataName(TB_MEMBER,"code",$member_id);
    $sql = "delete from " . TB_MEMBER_PHOTO . " where member_id='" . $member_id . "'";
    $G_DB_CONNECT->query($sql);

    for ($i = 0; $i < count($arr_member_photo_disabled); $i++) {

        $member_photo_img_old_path = $arr_member_photo_img_old_path[$i];

        $dir = "upload/images/member/";
        $file_name = "member_photo_img";
        ////////////////////////////////////////////////
        $tempFile = $_FILES[$file_name]['tmp_name'][$i];
        if ($tempFile != '') {
            $targetPath = CURRENT_DOCUMENT_ROOT . $dir;
            $ext = get_extension($_FILES[$file_name]['name'][$i]);
            //$new_file_name = $member_code."_".date("YmdHis")."_".getLastID(TB_MEMBER_PHOTO).$ext;
            $new_file_name = date("YmdHis") . "_" . getLastID(TB_MEMBER_PHOTO) . $ext;
            $targetFile = str_replace('//', '/', $targetPath) . $new_file_name;
            move_uploaded_file($tempFile, $targetFile);
            $targetFile = $dir . $new_file_name;
            ////////////////////////////////////////////////
            $update_member_photo_data = array();
            $update_member_photo_data['language_id'] = $arr_member_photo_language_id[$i];
            $update_member_photo_data['img'] = $targetFile;
            $update_member_photo_data['sort_order'] = $arr_member_photo_sort_order[$i];
            $update_member_photo_data['disabled'] = $arr_member_photo_disabled[$i];
            $update_member_photo_data['member_id'] = $member_id;
            $update_member_photo_data['create_date'] = 'null';
            $update_member_photo_data['create_by'] = '';
            $update_member_photo_data['last_update_by'] = '';
            $G_DB_CONNECT->query_insert(TB_MEMBER_PHOTO, $update_member_photo_data);
            ////////////////////////////////////////////////
            smart_resize_image("../" . $targetFile, "thumb", 120, 5000, true);
            smart_resize_image("../" . $targetFile, "img", 300, 5000, true);


        } else if ($member_photo_img_old_path != '') {
            ////////////////////////////////////////////////
            $update_member_photo_data = array();
            $update_member_photo_data['language_id'] = $arr_member_photo_language_id[$i];
            $update_member_photo_data['img'] = $member_photo_img_old_path;
            //$update_member_photo_data['member_color_id'] = $arr_member_photo_member_color_id[$i];
            $update_member_photo_data['sort_order'] = $arr_member_photo_sort_order[$i];
            $update_member_photo_data['disabled'] = $arr_member_photo_disabled[$i];
            $update_member_photo_data['member_id'] = $member_id;
            $update_member_photo_data['create_date'] = 'null';
            $update_member_photo_data['create_by'] = '';
            $update_member_photo_data['last_update_by'] = '';
            $G_DB_CONNECT->query_insert(TB_MEMBER_PHOTO, $update_member_photo_data);
            ////////////////////////////////////////////////

        } else {
            $member_id = ID;
            ////////////////////////////////////////////////
            $update_member_photo_data = array();
            $update_member_photo_data['language_id'] = $arr_member_photo_language_id[$i];
            $update_member_photo_data['img'] = 'upload/images/member/blank.png';
            //$update_member_photo_data['member_color_id'] = $arr_member_photo_member_color_id[$i];
            $update_member_photo_data['sort_order'] = $arr_member_photo_sort_order[$i];
            $update_member_photo_data['disabled'] = $arr_member_photo_disabled[$i];
            $update_member_photo_data['member_id'] = $member_id;
            $update_member_photo_data['create_date'] = 'null';
            $update_member_photo_data['create_by'] = '';
            $update_member_photo_data['last_update_by'] = '';
            $G_DB_CONNECT->query_insert(TB_MEMBER_PHOTO, $update_member_photo_data);
            ////////////////////////////////////////////////

        }

    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php include(DIR_COMMON . "meta_header.php"); ?>
    <script type="text/javascript" src="<?php echo DIR_THIS_MODULE_ACTION; ?>main.js"></script>
</head>
<body>
<div id="container">
    <?php include(DIR_COMMON . "header.php"); ?>
    <div id="main_content_container">
        <div id="inside_content">
            <!-- table_layout (start) -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_layout">
                <tr>
                    <td id="panel_left_menu"><?php include(DIR_COMMON . "leftmenu.php"); ?></td>
                    <td id="panel_content">


                        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_section">
                            <tr>
                                <td><?php include(DIR_COMMON . "mainnav.php"); ?></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>


                        <!-- edit table (start) -->

                        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_edit">
                            <tr>
                                <th><?php echo ACTION_NAME; ?><?php echo SECTION_NAME; ?></th>
                            </tr>
                            <tr>
                                <td id="warn_msg">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>


                                    <?php include(DIR_COMMON . "loading.php"); ?>
                                    <!-- main_content_area (start) -->
                                    <div id="main_content_area">
                                        <form name="frm_this_page" id="frm_this_page" method="POST"
                                              enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                                              target="_self" autocomplete="off">
                                            <input name="id" id="id" value="<?php echo $_REQUEST['id']; ?>"
                                                   type="hidden"/>
                                            <input name="sid" id="sid" value="<?php echo SID; ?>" type="hidden"/>
                                            <input name="action" id="action" value="<?php echo ACTION; ?>"
                                                   type="hidden"/>


                                            <input name="ajax_json_path" id="ajax_json_path"
                                                   value="<?php echo DIR_THIS_MODULE_ACTION . "ajax_json_data.php"; ?>"
                                                   type="hidden"/>
                                            <input name="WARN_CHANGE_PASSWORD_FAILURE" id="WARN_CHANGE_PASSWORD_FAILURE"
                                                   value="<?php echo WARN_CHANGE_PASSWORD_FAILURE; ?>" type="hidden"/>

                                            <input name="ajax_json_path2" id="ajax_json_path2"
                                                   value="<?php echo DIR_THIS_MODULE_ACTION . "json_refresh_country_list.php"; ?>"
                                                   type="hidden"/>
                                            <input name="show_confirm_page" id="show_confirm_page"
                                                   value="<?php echo $_REQUEST['show_confirm_page']; ?>" type="hidden"/>
                                            <input name="send_login" id="send_login" value="" type="hidden"/>

                                            <?php
                                            if ($_REQUEST['show_confirm_page'] == '') {

                                                ?>
                                                <table border="0" cellspacing="0" cellpadding="0" id="table_form">


                                                    <tr style="display:none">
                                                        <td class="sign_must_enter"></td>
                                                        <td class="title"><?php echo TITLE_USER_DISABLED; ?></td>

                                                        <td>


                                                            <?php

                                                            $sql = "select role.*, role_desc.name as name from " . TB_ROLE . " as role , " . TB_ROLE_DESC . " as role_desc ";
                                                            $sql .= " where ";
                                                            $sql .= " role.id=role_desc.role_id ";
                                                            $sql .= " and role_desc.language_id='" . ADMIN_LANG_ID . "' ";
                                                            $sql .= " and role.id>=2 ";
                                                            $sql .= " order by role.sort_order asc ";


                                                            printCustomMenu('role_id', $sql, 'name', '2', $edit_data['role_id'], '', '', '', '');

                                                            ?>


                                                        </td>

                                                    </tr>


                                                    <tr>
                                                        <td class="sign_must_enter"></td>
                                                        <td class="title"><?php echo TITLE_USER_DISABLED; ?></td>

                                                        <td>


                                                            <?php

                                                            $sql = "select status_allow.*, status_allow_desc.name as name from " . TB_STATUS_ALLOW . " as status_allow , " . TB_STATUS_ALLOW_DESC . " as status_allow_desc ";
                                                            $sql .= " where ";
                                                            $sql .= " status_allow.id=status_allow_desc.status_allow_id ";
                                                            $sql .= " and status_allow_desc.language_id='" . ADMIN_LANG_ID . "' ";
                                                            $sql .= " group by status_allow.id  ";
                                                            $sql .= " order by status_allow.sort_order asc ";


                                                            printCustomMenu('disabled', $sql, 'name', '0', $edit_data['disabled'], '', '', '', '');

                                                            ?>


                                                        </td>

                                                    </tr>


                                                    <tr>
                                                        <td class="sign_must_enter">
                                                            <div id="require"></div>
                                                        </td>
                                                        <td class="title"><?php echo TITLE_CODE; ?></td>
                                                        <td>
                                                            <?php
                                                            if (ACTION == '1') {
                                                                $edit_data['code'] = generateMemberCode();
                                                            }
                                                            ?>

                                                            <input name="code" id="code"
                                                                   value="<?php echo $edit_data['code'] ?>"
                                                                   label="<?php echo TITLE_CODE; ?>"
                                                                   class="input_middle" required="yes"/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="sign_must_enter">
                                                            <div id="require"></div>
                                                        </td>
                                                        <td class="title"><?php echo TITLE_USERNAME; ?></td>
                                                        <td><input name="username" id="username"
                                                                   value="<?php echo $edit_data['username'] ?>"
                                                                   label="<?php echo TITLE_USERNAME; ?>"
                                                                   class="input_middle" required="yes"
                                                                   warn_msg="<?php echo WARN_EMAIL; ?>"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="sign_must_enter"
                                                            style="vertical-align:top; padding-top:7px;">
                                                            <div id="require"></div>
                                                        </td>
                                                        <td class="title"
                                                            style="vertical-align:top"><?php echo TITLE_PASSWORD; ?></td>
                                                        <td><input name="password" id="password" value=""
                                                                   label="<?php echo TITLE_PASSWORD; ?>"
                                                                   class="input_middle" type="password"
                                                                   warn_msg="<?php echo WARN_NEW_PASSWORD_LEN; ?>" <?php echo NOTICE_PASSWORD; ?>  <?php if (ACTION == '1') {
                                                                echo 'required="yes" ';
                                                            } ?>/>
                                                            <div style="clear:both; padding-top:5px;"></div>
                                                            <?php
                                                            if (ACTION == '2') {
                                                                echo NOTICE_EMPTY_MEAN_NOT_CHANGE;
                                                            } else {
                                                                echo NOTICE_PASSWORD;
                                                            }
                                                            ?>

                                                        </td>
                                                    </tr>


                                                    <tr style="display:none">
                                                        <td class="sign_must_enter">
                                                            <div id="require"></div>
                                                        </td>
                                                        <td class="title"><?php echo TITLE_TITLE; ?></td>

                                                        <td>


                                                            <?php

                                                            $sql = "select title.*, title_desc.name as name from " . TB_TITLE . " as title , " . TB_TITLE_DESC . " as title_desc ";
                                                            $sql .= " where ";
                                                            $sql .= " title.id=title_desc.title_id ";
                                                            $sql .= " and title_desc.language_id='" . ADMIN_LANG_ID . "' ";
                                                            $sql .= " order by title.sort_order asc ";


                                                            printCustomMenu('title', $sql, 'name', '0', $edit_data['title'], '', '', '', '');

                                                            ?>


                                                        </td>

                                                    </tr>


                                                    <tr>
                                                        <td class="sign_must_enter">
                                                            <div id="require"></div>
                                                        </td>
                                                        <td class="title">Name</td>
                                                        <td><input name="givenname_en" id="givenname_en"
                                                                   value="<?php echo $edit_data['givenname_en'] ?>"
                                                                   label="Name" class="input_middle" required="yes"/>
                                                        </td>

                                                    </tr>


                                                    <tr style="display:none">
                                                        <td class="sign_must_enter">
                                                            <div id="require"></div>
                                                        </td>
                                                        <td class="title"><?php echo TITLE_SURNAME_EN; ?></td>
                                                        <td><input name="surname_en" id="surname_en"
                                                                   value="<?php echo $edit_data['surname_en'] ?>"
                                                                   label="<?php echo TITLE_SURNAME_EN; ?>"
                                                                   class="input_middle"/></td>

                                                    </tr>


                                                    <tr>
                                                        <td class="sign_must_enter">
                                                            <div id="require"></div>
                                                        </td>
                                                        <td class="title"><?php echo TITLE_EXPIRY_DATE; ?></td>
                                                        <td style="vertical-align:middle">

                                                            <table border="0" cellspacing="0" cellpadding="0"
                                                                   id="table_text">
                                                                <tr>
                                                                    <td style="padding-bottom:0px;">

                                                                        <?php
                                                                        if ($edit_data['expiry_date'] == '') {


                                                                            //$edit_data['expiry_date'] = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
                                                                            $edit_data['expiry_date'] = '9999-12-31';


                                                                        }


                                                                        ?>


                                                                        <input name="expiry_date" id="expiry_date"
                                                                               value="<?php echo $edit_data['expiry_date'] ?>"
                                                                               label="<?php echo TITLE_EXPIRY_DATE; ?>"
                                                                               class="input_middle input_date"
                                                                               required="yes"/>

                                                                    </td>

                                                                </tr>
                                                            </table>


                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td class="sign_must_enter"></td>
                                                        <td class="title" style="vertical-align:top">Internal Remarks
                                                        </td>
                                                        <td><textarea name="remark" id="remark"
                                                                      class="input_middle"><?php echo $edit_data['remark'] ?></textarea>
                                                        </td>

                                                    </tr>


                                                    <tr style="display:none">
                                                        <td class="sign_must_enter"></td>
                                                        <td class="title vtop"
                                                            style="padding-top:12px;"><?php echo TITLE_PHOTO; ?></td>
                                                        <td style="padding-top:0px;">

                                                            <div class="notice_msg"
                                                                 style="display:none"><?PHP echo NOTICE_SHOW_ONLY_FIRST_PHOTO; ?></div>

                                                            <table border="0" cellspacing="2" cellpadding="0"
                                                                   id="table_text2">

                                                                <tr>
                                                                    <td style="vertical-align:top"><?php echo TITLE_IMG ?>
                                                                        <br>
                                                                        <?php echo NOTICE_BEST_VIEW_PART_1; ?><?php echo TITLE_WIDTH; ?>
                                                                        : 112, <?php echo TITLE_HEIGHT; ?> :
                                                                        120<?php echo NOTICE_BEST_VIEW_PART_2; ?>
                                                                        <br>
                                                                        <?php echo NOTICE_FILE_FORMAT; ?> jpg, png, gif
                                                                    </td>
                                                                    <td style="vertical-align:top;display:none"><?php echo TITLE_LANG ?></td>
                                                                    <td style="vertical-align:top;display:none"><?php echo TITLE_SORT_ORDER ?></td>
                                                                    <td style="vertical-align:top;display:none"><?php echo TITLE_DISABLED ?></td>
                                                                    <td style="vertical-align:top">&nbsp;</td>
                                                                </tr>

                                                                <?php
                                                                $this_dynamic_area_id = "dynamic_member_photo";
                                                                ?>

                                                                <tr id="<?php echo $this_dynamic_area_id; ?>">
                                                                    <td>


                                                                        <input name="member_photo_img"
                                                                               id="member_photo_img" value=""
                                                                               label="<?php echo TITLE_IMG; ?>"
                                                                               type="file"
                                                                               class="input_file file_upload"/>
                                                                        <input name="member_photo_img_old_path"
                                                                               id="member_photo_img_old_path" value=""
                                                                               type="hidden"/>
                                                                    </td>


                                                                    <td style="display:none">

                                                                        <?php
                                                                        $sql = "select language.* from " . TB_LANGUAGE . " as language ";
                                                                        $sql .= " where ";
                                                                        $sql .= "for_front_page='1' order by sort_order";


                                                                        printCustomMenu('member_photo_language_id', $sql, 'name', '0', '', '', '', '', '');
                                                                        ?>

                                                                    </td>

                                                                    <td style="display:none"><input
                                                                                name="member_photo_sort_order"
                                                                                id="member_photo_sort_order" value=""
                                                                                label="<?php echo TITLE_SORT_ORDER; ?>"
                                                                                class="input_short sort_order"
                                                                                maxlength="5"/></td>


                                                                    <td style="display:none">


                                                                        <?php
                                                                        $sql = "select status_disable.*, status_disable_desc.name as name from " . TB_STATUS_DISABLE . " as status_disable , " . TB_STATUS_DISABLE_DESC . " as status_disable_desc ";
                                                                        $sql .= " where ";
                                                                        $sql .= " status_disable.id=status_disable_desc.status_disable_id ";
                                                                        $sql .= " and status_disable_desc.language_id='" . ADMIN_LANG_ID . "' ";
                                                                        $sql .= " group by status_disable.id  ";
                                                                        $sql .= " order by status_disable.sort_order asc ";


                                                                        printCustomMenu('member_photo_disabled', $sql, 'name', '0', '', '', '', '', '');
                                                                        ?>


                                                                    </td>
                                                                    <td style="width:250px;"><a href="#"
                                                                                                class="button btn_remove_member_photo"
                                                                                                style="display:none"><span><?php echo BTN_REMOVE; ?></span></a>
                                                                    </td>
                                                                </tr>


                                                                <?php

                                                                $photo_width = 112;
                                                                $photo_height = 5000;

                                                                $i = 0;
                                                                $sql = "select * from " . TB_MEMBER_PHOTO . " as member_photo  ";
                                                                $sql .= " where member_id='" . ID . "' ";
                                                                $sql .= " order by language_id asc,sort_order asc ";
                                                                $rows = $G_DB_CONNECT->query($sql);
                                                                if ($G_DB_CONNECT->affected_rows > 0) {
                                                                    while ($data = $G_DB_CONNECT->fetch_array($rows)) {

                                                                        $this_index = ++$i;

                                                                        $member_photo_img = "../" . $data['img'];
                                                                        $arr_file_info = getImageInfo($member_photo_img, "thumb", $photo_width, $photo_height);
                                                                        $member_photo_img_thumb = $arr_file_info["src"];

                                                                        //$arr_file_info["width"]
                                                                        //$arr_file_info["height"]


                                                                        ?>

                                                                        <tr id="<?php echo $this_dynamic_area_id; ?><?php echo $this_index; ?>"
                                                                            class="<?php echo $this_dynamic_area_id; ?>">

                                                                            <td style="text-align:center; vertical-align:middle;background-color:#F9F9F9">
                                                                                <div align="center">
                                                                                    <div style="width:<?php echo $photo_width; ?>px; vertical-align:middle">
                                                                                        <a href="<?php echo $member_photo_img; ?>"
                                                                                           target="_blank"><img
                                                                                                    src="<?php echo $member_photo_img_thumb ?>"
                                                                                                    style="margin-bottom:10px;"
                                                                                                    align="middle"
                                                                                                    width="<?php echo $arr_file_info['width'] ?>"
                                                                                                    height="<?php echo $arr_file_info['height'] ?>"/></a>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <input name="member_photo_img[]"
                                                                                       id="member_photo_img[]" value=""
                                                                                       label="<?php echo TITLE_PHOTO; ?>"
                                                                                       type="file"
                                                                                       class="input_file img_upload"/>
                                                                                <input name="member_photo_img_old_path[]"
                                                                                       id="member_photo_img_old_path[]"
                                                                                       value="<?php echo $data['img']; ?>"
                                                                                       type="hidden"/>
                                                                            </td>

                                                                            <td style="display:none">

                                                                                <?php
                                                                                $sql = "select language.* from " . TB_LANGUAGE . " as language ";
                                                                                $sql .= " where ";
                                                                                $sql .= "for_front_page='1' order by sort_order";


                                                                                printCustomMenu('member_photo_language_id[]', $sql, 'name', '0', $data['language_id'], '', '', '', '');
                                                                                ?>

                                                                            </td>


                                                                            <td style="display:none"><input
                                                                                        name="member_photo_sort_order[]"
                                                                                        id="member_photo_sort_order[]"
                                                                                        value="<?php echo $data['sort_order']; ?>"
                                                                                        label="<?php echo TITLE_SORT_ORDER; ?>"
                                                                                        class="input_short sort_order"
                                                                                        maxlength="5"/></td>


                                                                            <td style="display:none">


                                                                                <?php
                                                                                $sql = "select status_disable.*, status_disable_desc.name as name from " . TB_STATUS_DISABLE . " as status_disable , " . TB_STATUS_DISABLE_DESC . " as status_disable_desc ";
                                                                                $sql .= " where ";
                                                                                $sql .= " status_disable.id=status_disable_desc.status_disable_id ";
                                                                                $sql .= " and status_disable_desc.language_id='" . ADMIN_LANG_ID . "' ";
                                                                                $sql .= " group by status_disable.id  ";
                                                                                $sql .= " order by status_disable.sort_order asc ";


                                                                                printCustomMenu('member_photo_disabled[]', $sql, 'name', '0', $data['disabled'], '', '', '', '');
                                                                                ?>


                                                                            </td>
                                                                            <td style="width:250px;"><a href="#"
                                                                                                        class="button btn_remove_member_photo"
                                                                                                        style="display:none"><span><?php echo BTN_REMOVE; ?></span></a>
                                                                            </td>
                                                                        </tr>


                                                                        <?php


                                                                    }
                                                                }

                                                                ?>


                                                                <tr id="dynamic_member_photo_footer"
                                                                    style="display:none">
                                                                    <td colspan="5">&nbsp;</td>
                                                                </tr>


                                                            </table>


                                                            <div style="float:left;"><a href="#"
                                                                                        id="btn_add_member_photo"
                                                                                        class="button btn_add_member_photo"
                                                                                        style="display:none"><span><?php echo BTN_ADD_PHOTO; ?></span></a>
                                                            </div>

                                                        </td>
                                                    </tr>


                                                </table>


                                                <table border="0" cellspacing="0" cellpadding="0" id="table_edit">

                                                    <?php
                                                    if (ACTION == 2) {
                                                        ?>

                                                        <tr>
                                                            <td class="sign_must_enter"></td>
                                                            <td class="title"><?php echo TITLE_CREATE_DATE; ?></td>
                                                            <td style="padding-left:10px"><?php echo getCreateInfo($edit_data['create_date'], $edit_data['create_by']) ?></td>

                                                        </tr>
                                                        <tr>
                                                            <td class="sign_must_enter"></td>
                                                            <td class="title"><?php echo TITLE_LAST_UPDATE_DATE; ?></td>
                                                            <td style="padding-left:10px"> <?php echo getUpdateInfo($edit_data['last_update_date'], $edit_data['last_update_by']) ?></td>

                                                        </tr>
                                                        <tr style="display:none">
                                                            <td class="sign_must_enter"></td>
                                                            <td class="title"><?php echo TITLE_LAST_LOGIN_DATE; ?></td>
                                                            <td style="padding-left:10px"> <?php echo $edit_data['last_login_date']; ?></td>

                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>


                                                </table>


                                                <div id="table_form_bottom"></div>
                                                <?php include(DIR_COMMON . "print_list_search.php"); ?>
                                                <?php
                                            } //if($_REQUEST['show_confirm_page'] != '1'){
                                            ?>
                                        </form>
                                    </div>
                                    <!-- main_content_area (end) -->
                                    <?php include(DIR_THIS_MODULE_ACTION . "confirm_msg.php"); ?>
                                </td>
                            </tr>
                        </table>
                        <!-- edit record table (end) -->

                    </td>
                </tr>
            </table>
            <!-- table_layout (end) -->


            <!-- fixed_action_button_area (start) -->
            <div id="fixed_action_button_area">
                <div id="fixed_action_button_area_container">
                    <div class="button_box">
                        <ul>

                            <li class="main"><a href="#" id="btn_back_to_list"
                                                class="btn_back_to_list"><span><?php echo BTN_BACK_TO_LIST; ?></span></a>
                            </li>

                            <?php
                            if (ACTION == 2) {
                                ?>
                                <li><a href="#" class="btn_delete"><span><?php echo BTN_DELETE; ?></span></a></li>
                                <li style="display:none"><a href="#" class="btn_send_login"><span>Confirm and send login info</span></a>
                                </li>
                                <?php
                            }
                            ?>
                            <li><a href="#" id="btn_reset"><span><?php echo BTN_RESET; ?></span></a></li>

                            <li><a href="#" id="btn_confirm"><span><?php echo BTN_CONFIRM; ?></span></a></li>
                        </ul>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div style="clear:both"></div>
            </div>
            <!-- fixed_action_button_area (end) -->


            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
    </div>
    <!-- main_content_container, inside_content (end) -->
    <div style="clear:both"></div>
</div>
<!-- container  (end) -->
<?php include(DIR_COMMON . "footer.php"); ?>
</body>
</html>
