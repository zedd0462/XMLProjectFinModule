<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:param name="date_dep"></xsl:param>
<xsl:param name="ville_dep"></xsl:param>
<xsl:param name="ville_arr"></xsl:param>
  <xsl:template match="/">
    <html>
      <head>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="main.css"/>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <title>Liste des Voyages</title>
      </head>
      <body>
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded navbar-expand bg-white">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.html">GestTrain</a>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
                
              </ul>
            </div>
        </nav>
        <h1 style="text-align:center" class="my-5">Liste des Voyages de <xsl:value-of select="$date_dep"></xsl:value-of>:</h1>
        <div class="container">
          <table border="1" class="w-100 bg-white">
            <tr>
              <th>Gare Depart</th>
              <th>Gare Arrive</th>
              <th>Classe</th>
              <th>Date depart</th>
              <th>Heure depart</th>
              <th>Prix</th>
            </tr>
            <xsl:variable name="g_depart">
              <xsl:value-of select="/gestion_trains/gares/gare[ville = $ville_dep]/@id_gare"></xsl:value-of>
            </xsl:variable>
            <xsl:variable name="g_arrive">
              <xsl:value-of select="/gestion_trains/gares/gare[ville = $ville_arr]/@id_gare"></xsl:value-of>
            </xsl:variable>
            <xsl:for-each select="/gestion_trains/voyages/voyage[date_dep=$date_dep and @gare_depart=$g_depart and @gare_arrive=$g_arrive]">
            <xsl:sort select="heure_dep" order="ascending" />
              <tr>
                <td>
                  <xsl:variable name="gdepart">
                    <xsl:value-of select="@gare_depart"></xsl:value-of>
                  </xsl:variable>
                  <xsl:value-of select="/gestion_trains/gares/gare[@id_gare = $gdepart]/ville"/>
                </td>
                <td>
                  <xsl:variable name="garrive">
                    <xsl:value-of select="@gare_arrive"></xsl:value-of>
                  </xsl:variable>
                  <xsl:value-of select="/gestion_trains/gares/gare[@id_gare = $garrive]/ville"/>
                </td>
                <td>
                  <xsl:value-of select="@id_classe"/>
                </td>
                <td>
                  <xsl:value-of select="date_dep"/>
                </td>
                <td>
                  <xsl:value-of select="heure_dep"/>
                </td>
                <td>
                  <xsl:value-of select="prix"/> DH
                </td>
                <td style="text-align : center">
                  <a class="btn btn-primary">
                    <xsl:attribute name="href">
                      ticket.php?id_voyage=<xsl:value-of select="@id_voyage"/>
                    </xsl:attribute>
                    Réserver Un Siége
                  </a>
                </td>
              </tr>
            </xsl:for-each>
          </table>
        </div>
        
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
