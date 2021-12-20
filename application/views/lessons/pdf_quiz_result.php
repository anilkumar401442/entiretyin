<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Entiretyin</title>
        <style type="text/css">
        .table-width{width: 700px;}
        .reciept-name{font-size: 25px;  font-weight: 600;}
        .school-address{margin-bottom: -10px;text-align: center;font-size: 18px;
    font-weight: bold; color: #555;}
        /*.school-phoneno{padding-top: -60px;margin-bottom: -10px;}*/
        .img-td{width: 70px;}
        .img-td img{width: 90px;}
        .detail{ text-align: center;}
        .rct-no{margin-bottom: 30px; margin-top: -20px;}
        .rct-date{margin-bottom: 30px; margin-top: -25px;}
        .paid-date{margin-bottom: 15px; margin-top: -22px;}
        .rct-detail{border-bottom:1px solid red;}
        .border-bottom-td{border-bottom: 1px solid #abaaaa;}
        .addmission-detail{}
        .addmission-detail-p{margin-top: -10px;}
        .amt-detail{width: 700px;}
        .sec-amt{padding-top: 20px; padding-bottom: 5px;}
        .total-amt{width: 600px;}
        </style>
    </head>
    <body>
        <table class="table-width">
            <tr>
                            <td class="detail_space">&nbsp;</td>
                            <td class="detail">
                                <h3 class="reciept-name">ENTIRETYIN PVT. LTD.</h3>
                                <h4>www.entiretyin.com</h4>
                            </td>
                            <td>
                                <p class="rct-no"><span>Recognized by the</span></p>
                                <p class="rct-date"><span>Govt. of Telangana</span></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="detail_space">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td>
                                <h1 style="font-size: 40px;font-family: Candara;margin-left: 70px;">Course Certificate</h1>
                            </td>
                        </tr>
                        <tr>
                            <td class="detail_space_one">&nbsp;</td>
                            <td>
                                <h3 style="margin-left: 100px;">T H I S  &nbsp; I S &nbsp;  A W A R D E D &nbsp; T O</h3>
                            </td>
                        </tr>
                        <tr>
                            <table>
                                <tr>
                                    <td class="addmission-detail" >
                                        <h3 style="font-size: 21px;">Mr/Ms. <?php echo $user['first_name']; ?> in appreciation of his/her work and time as a <?php echo $courses['title']; ?>.</h3>
                                    </td>
                                </tr>
                            </table>

                        </tr>


    </table><br><br><br>
    <table class="table-width">
            <tr>
                            <td class="detail_space">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td>
                                <p class="rct-no">FROM : <?php echo date("d-m-Y", strtotime($user['created_on'])); ?></p>

                            </td>
                            <td>
                                <p class="rct-no"><span>TO : <?php echo date("d-m-Y"); ?></span></p>
                            </td>
                        </tr>



    </table><br><br>
    <table class="table-width">
            <tr>
                            <td class="detail_space">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td>
                                <p class="rct-no">Uday Kumar</p>

                            </td>
                            <td>
                                <p class="rct-no"><?php echo date('j M,Y'); ?></p>
                            </td>
                        </tr>



    </table>
    <table class="table-width">
            <tr>
                            <td class="detail_space">&nbsp;</td>
                            <td>
                                <p class="rct-no" style="margin-left: 100px;">CEO</p>

                            </td>
                            <td>
                                <p class="rct-no" style="margin-right: 50px;">DATE</p>
                            </td>
                        </tr>



    </table>
</body>
</html>

