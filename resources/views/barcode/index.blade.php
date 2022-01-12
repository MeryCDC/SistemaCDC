<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0088)http://controldecarga.ecusmart.net/sistema/paginas/print_label2.php?codguia=SLW402000251 -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Etiqueta</title>
</head>
<body style="margin:0px; padding:0px; font-family:Verdana, Geneva, sans-serif;" onload="self.print();">
    <div style="margin:3px; padding:3px; text-align:center; vertical-align:middle;">
        <!--<table border="1" width="377" height="577">-->
        <table border="0" width="377" height="500">
            <tbody>
                <tr>
                    <td>
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td align="left" style="padding-left: 15px;">
                                        Etiqueta
                                    </td>
                                    <td style="text-align: right;">
                                        <span style="font-size: 13px; font-weight: bold;"> {{ date('Y-m-d H:i') }} </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="padding-left: 15px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td style="vertical-align: top; font-size: 20px;"><b>ID:</b> {{ $guia->id }} </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top; font-size: 20px;"><b>Dimensiones:</b> {{ $guia->alto }} x {{ $guia->largo }} x {{ $guia->ancho }} in</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top; font-size: 20px;"><b>Peso:</b> {{ $guia->peso }} lb</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>

                </tr>
                <tr style="border-bottom: 1px solid red">
                    <td>
                        <span style="font-size:28px; font-weight: bold;">
                            ID: {{ $guia->id }}</span>
                        <br>
                        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($guia->id, 'C39')}}" alt="barcode" /><br><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                   {{--  --}}
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table border="1" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td align="center" style="padding: 2px;">
                                        <span style="font-size: 14px; font-weight: bold;">PAQUETE SIN IDENTIFICAR</span><br>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                       
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>