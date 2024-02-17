<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:param name="ticket_id"/>
    <xsl:output method="html" indent="yes"/>
    <xsl:template match="/">
        <html>
        <head>
            <meta charset="UTF-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <title>Ticket</title>
            <link rel="stylesheet" href="ticket.css"/>
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
            <link rel="stylesheet" href="main.css"/>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
            <script src="bootstrap/js/bootstrap.min.js"></script>
            <script src="lib/html2pdf/html2pdf.bundle.js"></script>
            <script src="lib/html2pdf/printAsPdf.js"></script>
        </head>
        <body>
            <xsl:for-each select="/gestion_trains/tickets/ticket[@id_ticket=$ticket_id]">
                <xsl:variable name="owner_firstname">
                    <xsl:value-of select="/gestion_trains/utilisateurs/utilisateur[@username=current()/@username]/prenom"/>
                </xsl:variable>
                <xsl:variable name="owner_lastname">
                    <xsl:value-of select="/gestion_trains/utilisateurs/utilisateur[@username=current()/@username]/nom"/>
                </xsl:variable>
                <xsl:variable name="num_ticket">
                    <xsl:value-of select="@id_ticket"/>
                </xsl:variable>
                <xsl:variable name="gare_depart_id">
                    <xsl:value-of select="/gestion_trains/voyages/voyage[@id_voyage=current()/@id_voyage]/@gare_depart"/>
                </xsl:variable>
                <xsl:variable name="gare_arrive_id">
                    <xsl:value-of select="/gestion_trains/voyages/voyage[@id_voyage=current()/@id_voyage]/@gare_arrive"/>
                </xsl:variable>
                    
                <xsl:variable name="gare_depart_name">
                    <xsl:value-of select="/gestion_trains/gares/gare[@id_gare=$gare_depart_id]/ville"/>
                </xsl:variable>
                <xsl:variable name="gare_arrive_name">
                    <xsl:value-of select="/gestion_trains/gares/gare[@id_gare=$gare_arrive_id]/ville"/>
                </xsl:variable>
                <xsl:variable name="classe">
                    <xsl:value-of select="/gestion_trains/voyages/voyage[@id_voyage=current()/@id_voyage]/@id_classe"/>
                </xsl:variable>
                <xsl:variable name="date_depart">
                    <xsl:value-of select="/gestion_trains/voyages/voyage[@id_voyage=current()/@id_voyage]/date_dep"/>
                </xsl:variable>
                <xsl:variable name="heure_depart">
                    <xsl:value-of select="/gestion_trains/voyages/voyage[@id_voyage=current()/@id_voyage]/heure_dep"/>
                </xsl:variable>
                <div class="ticketContainer" id="ticketContainer">
                    <div class="leftContainer">
                        <div class="qrContainer">
                            <div class="imgContainer">
                                <img 
                                    style="border-radius: 10px;"
                                    height="100%" 
                                    width="100%" 
                                    class="qrCode"
                                    alt="QR code"
                                >
                                <xsl:attribute name="src">
                                    <xsl:text>/ticketqrcode.php?id_ticket=</xsl:text>
                                    <xsl:value-of select="$num_ticket"/>
                                </xsl:attribute> 
                                    
                                </img>
                            </div>
                        </div>
                        <div class="idContainer">
                            <div class="ticketID">
                                <xsl:value-of select="$num_ticket"/>
                            </div>
                        </div>
                    </div>
                    <div class="rightContainer">
                        <div class="infoContainer">
                            <div class="infoHeader">
                                <xsl:value-of select="$gare_depart_name"/> <img style="vertical-align:middle" src="arrow.png" height="30px"/> <xsl:value-of select="$gare_arrive_name"/>
                            </div>
                            <table style="color: #F8D648;font-weight: 600;">
                                <tr>
                                    <td>Nom:</td><td class="infoData"><xsl:value-of select="$owner_lastname"/></td>
                                </tr>
                                <tr>
                                    <td>Prénom:</td><td class="infoData"><xsl:value-of select="$owner_firstname"/></td>
                                </tr>
                                <tr>
                                    <td>Gare Depart:</td><td class="infoData"><xsl:value-of select="$gare_depart_name"/></td>
                                </tr>
                                <tr>
                                    <td>Gare Arrive:</td><td class="infoData"><xsl:value-of select="$gare_arrive_name"/></td>
                                </tr>
                                <tr>
                                    <td>Classe:</td><td class="infoData"><xsl:value-of select="$classe"/></td>
                                </tr>
                                <tr>
                                    <td>Date depart:</td><td class="infoData"><xsl:value-of select="$date_depart"/></td>
                                </tr>
                                <tr>
                                    <td>Heure depart:</td><td class="infoData"><xsl:value-of select="$heure_depart"/></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <br/>
                <button class="btn btn-primary mx-4" onclick="printAsPDF()">Télécharger votre ticket</button>
            </xsl:for-each>
        </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
