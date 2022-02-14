<?php 
    $style = [
        'head' => 'padding: 5px 0px 0px 10px;text-align:center;',
        'img' => 'width: 220px;height: auto;',
        'body' => 'background: white;text-align:center;margin-top: 20px;border-radius: 5px;border: 1px solid #422800;padding: 10px;box-shadow: 5px 10px #ccc;',
        'p' => ' font-family: sans-serif;',
        'footer' => 'margin-top: 10px;',
        'table' => 'font-family:sans-serif;border-collapse: collapse;width:100%;',
        'th' => 'border: 1px solid #422800;padding: 8px;padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #3399cc;color: #422800;',
        'td' => 'border: 1px solid #422800;padding: 8px;text-align:left',
    ];

?>


<div>
    <div style="<?= $style['head'] ?>">
        <img style="<?= $style['img'] ?>" src="<?= LOGO_KF ?>" alt="kf">
        <hr style="border: 1px solid #422800">
        <p><b>PT. Kimia Farma Tbk. Plant Jakarta</b></p>
    </div>

    <div style="<?= $style['body'] ?>">
        <p>Dear Bapak/Ibu <b><?= $data['name'] ?></b>,</p>
        <p>Berikut ini data <b>Username & Password</b> yang dapat anda gunakan untuk <b>Login</b> di Aplikasi <a href='https://spekta.id/spektachat'>S.P.E.K.T.A Chat</a></p>
        <p>Username: <b><?= str_replace('@kimiafarma.co.id', '', $data['email']) ?></b></p>
        <p>Password: <b><?= $data['sap_id'] ?></b></p>
    </div>

    <div style="<?= $style['footer'] ?>">
    <p>Notifikasi email ini dikirim secara otomatis oleh sistem dan tidak memerlukan balasan</p>
        <hr>
        <p>Kw. Industri Pulo Gadung, Blok N6-11, Jl. Rw. Gelam V No.1, RW.9, Jatinegara, Kec. Cakung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13920</p>
    </div>
</div>