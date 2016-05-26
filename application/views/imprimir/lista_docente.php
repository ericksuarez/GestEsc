<html>

    <head>
        <meta http-equiv=Content-Type content="text/html; charset=windows-1252">
        <meta name=Generator content="Microsoft Word 14 (filtered)">
        <title><?php echo $this->config->item('NomEscuela'); ?></title>
        <style>
            <!--
            /* Font Definitions */
            @font-face
            {font-family:Calibri;
             panose-1:2 15 5 2 2 2 4 3 2 4;}
            @font-face
            {font-family:Tahoma;
             panose-1:2 11 6 4 3 5 4 4 2 4;}
            /* Style Definitions */
            p.MsoNormal, li.MsoNormal, div.MsoNormal
            {margin-top:0in;
             margin-right:0in;
             margin-bottom:10.0pt;
             margin-left:0in;
             line-height:115%;
             font-size:11.0pt;
             font-family:"Calibri","sans-serif";}
            h1
            {mso-style-link:"Heading 1 Char";
             margin-top:24.0pt;
             margin-right:0in;
             margin-bottom:0in;
             margin-left:0in;
             margin-bottom:.0001pt;
             line-height:115%;
             page-break-after:avoid;
             font-size:14.0pt;
             font-family:"Cambria","serif";
             color:#365F91;}
            p.MsoHeader, li.MsoHeader, div.MsoHeader
            {mso-style-link:"Header Char";
             margin:0in;
             margin-bottom:.0001pt;
             font-size:11.0pt;
             font-family:"Calibri","sans-serif";}
            p.MsoFooter, li.MsoFooter, div.MsoFooter
            {mso-style-link:"Footer Char";
             margin:0in;
             margin-bottom:.0001pt;
             font-size:11.0pt;
             font-family:"Calibri","sans-serif";}
            p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
            {mso-style-link:"Balloon Text Char";
             margin:0in;
             margin-bottom:.0001pt;
             font-size:8.0pt;
             font-family:"Tahoma","sans-serif";}
            span.Heading1Char
            {mso-style-name:"Heading 1 Char";
             mso-style-link:"Heading 1";
             font-family:"Cambria","serif";
             color:#365F91;
             font-weight:bold;}
            span.BalloonTextChar
            {mso-style-name:"Balloon Text Char";
             mso-style-link:"Balloon Text";
             font-family:"Tahoma","sans-serif";}
            span.HeaderChar
            {mso-style-name:"Header Char";
             mso-style-link:Header;}
            span.FooterChar
            {mso-style-name:"Footer Char";
             mso-style-link:Footer;}
            .MsoPapDefault
            {margin-bottom:10.0pt;
             line-height:115%;}
            /* Page Definitions */
            @page WordSection1
            {size:8.5in 11.0in;
             margin:1.0in 1.0in 1.0in 1.0in;}
            div.WordSection1
            {page:WordSection1;}
            -->
        </style>

    </head>

    <body lang=EN-US>

        <div class=WordSection1>
            <?php if($Imagen){?>
            <p class=MsoNormal><span style='position:relative;z-index:251658237'><span
                        style='position:absolute;left:551px;top:-2px;width:117px;height:117px'><img
                            width=117 height=117 src="<?php echo base_url() . 'images/logo.jpg' ?>"></span></span>                                                                                                                                                                                                               </p>
            <?php }?>
            <p class=MsoNormal align=center style='text-align:center'><b><i><span
                            style='font-size:20.0pt;line-height:115%'><?php echo $this->config->item('NomEscuela'); ?></span></i></b></p>

            <p class=MsoNormal align=center style='text-align:center'><b><i><span
                            style='font-size:10.0pt;line-height:115%'>Lista de Docentes</span></i></b></p>

            <p class=MsoNormal>&nbsp;</p>

             <table class=MsoTableLightShading border=1 cellspacing=0 cellpadding=0
                   align=left style='background:white;border-collapse:collapse;border:none;
                   margin-left:6.75pt;margin-right:6.75pt'>
                <tr>
                    <td width=91 valign=top style='width:.95in;border-top:solid black 1.0pt;
                        border-left:none;border-bottom:solid black 1.0pt;border-right:none;
                        padding:0in 5.4pt 0in 5.4pt'>
                        <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
                           text-align:center;line-height:normal'><b><span style='color:black'>NOMBRE</span></b></p>
                    </td>
                    <td width=91 valign=top style='width:.95in;border-top:solid black 1.0pt;
                        border-left:none;border-bottom:solid black 1.0pt;border-right:none;
                        padding:0in 5.4pt 0in 5.4pt'>
                        <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
                           text-align:center;line-height:normal'><b><span style='color:black'>TURNO</span></b></p>
                    </td>
                    <td width=91 valign=top style='width:.95in;border-top:solid black 1.0pt;
                        border-left:none;border-bottom:solid black 1.0pt;border-right:none;
                        padding:0in 5.4pt 0in 5.4pt'>
                        <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
                           text-align:center;line-height:normal'><b><span style='color:black'>GRUPOS</span></b></p>
                    </td>
                    <td width=91 valign=top style='width:.95in;border-top:solid black 1.0pt;
                        border-left:none;border-bottom:solid black 1.0pt;border-right:none;
                        padding:0in 5.4pt 0in 5.4pt'>
                        <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
                           text-align:center;line-height:normal'><b><span style='color:black'>MATERIAS</span></b></p>
                    </td>
                    <td width=91 valign=top style='width:.95in;border-top:solid black 1.0pt;
                        border-left:none;border-bottom:solid black 1.0pt;border-right:none;
                        padding:0in 5.4pt 0in 5.4pt'>
                        <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
                           text-align:center;line-height:normal'><b><span style='color:black'>FEC. ALTA</span></b></p>
                    </td>
                </tr>
                <?php foreach ($docente as $key => $info) { ?>
                    <tr>
                        <td width=91 valign=top style='width:.95in;border:none;border-bottom:solid black 1.0pt;
                            padding:0in 5.4pt 0in 5.4pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
                               text-align:center;line-height:normal'><i><span style='color:black'>
                                        <?php echo $info['Nombre'] . ' ' . $info['AMaterno'] . ' ' . $info['APaterno']; ?></span></i></p>
                        </td>
                        <td width=91 valign=top style='width:.95in;border:none;border-bottom:solid black 1.0pt;
                            padding:0in 5.4pt 0in 5.4pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
                               text-align:center;line-height:normal'><i><span style='color:black'>
                                        <?php echo $info['Turno_IDTurno']; ?></span></i></p>
                        </td>
                        <td width=91 valign=top style='width:.95in;border:none;border-bottom:solid black 1.0pt;
                            padding:0in 5.4pt 0in 5.4pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
                               text-align:center;line-height:normal'><i><span style='color:black'>
                                        <?php echo $info['Grupos']; ?></span></i></p>
                        </td>
                        <td width=91 valign=top style='width:.95in;border:none;border-bottom:solid black 1.0pt;
                            padding:0in 5.4pt 0in 5.4pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
                               text-align:center;line-height:normal'><i><span style='color:black'>
                                        <?php echo $info['Materias']; ?></span></i></p>
                        </td>
                        <td width=91 valign=top style='width:.95in;border:none;border-bottom:solid black 1.0pt;
                            padding:0in 5.4pt 0in 5.4pt'>
                            <p class=MsoNormal align=center style='margin-bottom:0in;margin-bottom:.0001pt;
                               text-align:center;line-height:normal'><i><span style='color:black'>
                                        <?php echo $info['FecInscripcion']; ?></span></i></p>
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

            <p class=MsoNormal>&nbsp;</p>

             <div style='border:none;border-top:solid #A5A5A5 1.0pt;padding:1.0pt 0in 0in 0in'>

                <p class=MsoFooter align=right style='text-align:right;border:none;padding:
                   0in'><span style='font-size:8.0pt;color:#7F7F7F'>&nbsp;</span></p>

                <p class=MsoFooter align=right style='text-align:right;border:none;padding:
                   0in'><span style='position:absolute;z-index:251660288;left:0px;margin-left:
                        -2px;margin-top:4px;width:76px;height:30px'><img width=76 height=30
                           src="<?php echo base_url() . 'images/image003.png' ?>">
                    </span><span style='font-size:8.0pt;color:#7F7F7F'><?php echo $this->config->item('Direccion'); ?></span></p>

                <p class=MsoFooter align=right style='text-align:right;border:none;padding:
                   0in'><span style='font-size:8.0pt;color:#7F7F7F'>&nbsp;</span></p>

            </div>

        </div>

    </body>

</html>
