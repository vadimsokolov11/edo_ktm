<?php

$title = 'Продукция';
ob_start(); 
?>

<h1><?= $title ?></h1>
<div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="/<?= APP_BASE_PATH ?>/product/list_plan" style="text-decoration: none;">
                                        <div class="card mb-3">
                                            <div class="card-body card-color">
                                                <h5 class="card-text">План производства готовой продукции на месяц</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card  mb-3">
                                        <div class="card-body card-color">
                                          <h5 class="card-text">График производства продукции в месяц</h5>
                                          <div class="card-btn">
                                            <a class="btn btn-primary" href="spisok_graphick_produckt.html">
                                                Бригада 1
                                              </a>
                                              <a class="btn btn-primary" href="spisok_graphick_produckt.html">
                                                Бригада 2
                                              </a>
                                              <a class="btn btn-primary" href="spisok_graphick_produckt.html">
                                                Бригада 3
                                              </a>
                                              <a class="btn btn-primary" href="spisok_graphick_produckt.html">
                                                Бригада 4
                                              </a>
                                          </div>
                                          
                                        </div>
                                      </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="#" style="text-decoration: none;">
                                        <div class="card  mb-3">
                                            <div class="card-body card-color">
                                                <h5 class="card-text">График производства продукции общий</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="/<?= APP_BASE_PATH ?>/product/spravka_product" style="text-decoration: none;">
                                        <div class="card  mb-3">
                                            <div class="card-body card-color">
                                                <h5 class="card-text">Справка по продукции</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div> 
<?php $content = ob_get_clean(); 

include 'app/views/layout/layout.php';
?>