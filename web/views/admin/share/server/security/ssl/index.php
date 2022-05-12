<?php require_once('views/admin/share/header.php'); ?>
    <div id="layoutSidenav">
        <?php require_once('views/admin/share/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/admin/share/title.php') ?>
                            <?php require_once('views/admin/share/server/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <?php require_once("views/admin/share/server/$setting/tab.php") ?>
                                <!-- start -->
                                <div class="tab-content">
                                    <?php
                                        if ((int)$webssl==1):
                                    ?>
                                    <div id="ssl" class=" pr-3 pl-3 tab-pane active"><br>
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>Valid Date</th>
                                                <th>Action</th>
                                            </tr>
                                            <tr>
                                                <td><?= sslexp($webdomain); ?> Days</td>
                                                <td>
                                                    <a href="javascript:;" class="btn btn-outline-info btn-sm common_dialog">Renew</a>
                                                    <a href="javascript:;" class="btn btn-outline-danger btn-sm common_dialog" >削除</a></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php
                                        else:
                                    ?>
                                    <div id="ssl" class=" pr-3 pl-3 tab-pane active"><br>
                                        <form action="/admin/share/server?setting=security&tab=ssl&act=confirm&webid=<?=$webid?>" method="post" id="free-ssl">
                                            <input type="hidden" name="action" value="new">
                                            <div class="form-group row">
                                                <span class="col">無料SSL設定</span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">コモンネーム</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="例：www.assistup.co.jp">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="country" class="col-sm-2 col-form-label">COUNTRY</label>
                                                <div class="col-sm-8 country-jp">
                                                    <span>ＪＰ</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="prefecture " class="col-sm-2 col-form-label">都道府県（Ｓ）</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="prefecture" name="prefecture" placeholder="例：Osaka">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="municipality" class="col-sm-2 col-form-label">市区町村（Ｌ）</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="municipality" name="municipality" placeholder="例：Osaka-si">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="organization" class="col-sm-2 col-form-label">組織名（Ｏ）</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="organization" name="organization" placeholder="例：assistup Inc. ">
                                                </div>
                                            </div>
                                            
                                            <!-- <div class="form-group row">
                                                <label for="department" class="col-sm-2 col-form-label">部署名（ＯＵ）</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="department" name="department" placeholder="例：System Development Section">
                                                </div>
                                            </div> -->
                                            
                                            <div class="form-group row">
                                                <span class="text-danger notice-msg col-sm-10">半角にてご入力ください。全角では入力できません。</span>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <span class="text-danger notice-msg col-sm-10">SSLの反映にはお時間がかかります。しばらく待ってからご確認をお願い致します。</span>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-3 mal-auto">
                                                    <button class="btn btn-outline-info btn-sm common_dialog btn-block" type="submit" data-toggle="modal" data-target="#common_modal" gourl="/admin/share/servers/sites/basic?act=new&webid=<?=$webid?>&error_pages">登録</button>
                                                </div>
                                                <div class="col-sm-3"></div>
                                            </div>
                                            <div class="form-group row">
                                                <span class="col">有料SSL設定</span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="ssl-list" class="col-sm-2 col-form-label">有料SSL</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control">
                                                        <option>オプションで申し込んでいているSSL種別を記載</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exp-date" class="col-sm-2 col-form-label">SSL有効期限</label>
                                                <div class="col-sm-8">
                                                    <input type="text" readonly class="form-control" id="exp-date" name="exp_date" value=" 2020/10/8">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php endif;
                                    ?>
                                </div>
                                <!-- end content -->
                            </div>
                    </div>
                </main>
            </div>
        </div> 
 <?php require_once("views/admin/share/footer.php"); ?>
