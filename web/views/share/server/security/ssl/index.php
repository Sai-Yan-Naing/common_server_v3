<?php require_once('views/share/header.php'); ?>
<?php $webssl = json_decode($webssl); ?>
    <div id="layoutSidenav">
        <?php require_once('views/share/sidebar.php');?>
            <div id="layoutSidenav_content">
            <main class="main-page">
                    <div class="container-fluid px-4">
                            <?php require_once('views/share/title.php') ?>
                            <?php require_once('views/share/server/subtitle.php') ?>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <?php require_once("views/share/server/$setting/tab.php") ?>
                                <!-- start -->
                                <div class="tab-content">
                                    <?php
                                        if ((int)count($webssl)!=0):
                                    ?>
                                    <div id="ssl" class=" pr-3 pl-3 tab-pane active"><br>
                                        <form action="/share/server?setting=security&tab=ssl&act=confirm&webid=<?=$webid?>" method="post" id="free-ssl">
                                            <input type="hidden" name="action" value="edit">
                                            <div class="form-group row">
                                                <span class="col">無料SSL設定</span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">コモンネーム</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="common_name" name="common_name" placeholder="例：www.assistup.co.jp" value="<?= $webssl->ssl->common_name ?>">
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
                                                    <input type="text" class="form-control" id="prefecture" name="prefecture" placeholder="例：Osaka" value="<?= $webssl->ssl->prefecture ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="municipality" class="col-sm-2 col-form-label">市区町村（Ｌ）</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="municipality" name="municipality" placeholder="例：Osaka-si" value="<?= $webssl->ssl->municipality ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="organization" class="col-sm-2 col-form-label">組織名（Ｏ）</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="organization" name="organization" placeholder="例：assistup Inc. " value="<?= $webssl->ssl->organization ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="organization" class="col-sm-2 col-form-label">有効期限</label>
                                                <div class="col-sm-8">
                                                    <label><?= sslexp($webdomain) ?>（<?= dateDiffInDays(sslexp($webdomain), Date('Y/m/d'));?>日後に自動更新されます）</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-6 mal-auto">
                                                    <button class="btn btn-outline-info btn-sm common_dialog " type="submit" data-toggle="modal" data-target="#common_modal" gourl="">更新</button>
                                                    <button class="btn btn-outline-danger btn-sm " type="submit"  form="ssl-delete">削除</button>
                                                </div>
                                                <div class="col-sm-3"></div>
                                            </div>
                                        </form>

                                            <form action="/share/server?setting=security&tab=ssl&act=confirm&webid=<?=$webid?>" method="post" id="ssl-delete">
                                            <input type="hidden" name="action" value="delete">
                                                
                                            </form>

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
                                    </div>
                                    <?php
                                        else:
                                    ?>
                                    <div id="ssl" class=" pr-3 pl-3 tab-pane active"><br>
                                        <form action="/share/server?setting=security&tab=ssl&act=confirm&webid=<?=$webid?>" method="post" id="free-ssl">
                                            <input type="hidden" name="action" value="new">
                                            <div class="form-group row">
                                                <span class="col">無料SSL設定</span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">コモンネーム</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="common_name" name="common_name" placeholder="例：www.assistup.co.jp">
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
                                                    <button class="btn btn-outline-info btn-sm common_dialog btn-block" type="submit" data-toggle="modal" data-target="#common_modal" gourl="/share/servers/sites/basic?act=new&webid=<?=$webid?>&error_pages">登録</button>
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
 <?php require_once("views/share/footer.php"); ?>
