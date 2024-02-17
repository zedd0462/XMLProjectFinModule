<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:param name="username"></xsl:param>
  <xsl:template match="/">
    <html>
      <head>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="main.css"/>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <title>Liste des tickets</title>
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
        <h1 style="text-align:center" class="my-5">Liste des tickets de <xsl:value-of select="$username"></xsl:value-of>:</h1>
        <div class="container">
            <table border="1" class="w-100 bg-white">
                <tr>
                  <th>Num_ticket</th>
                  <th>Gare Depart</th>
                  <th>Gare Arrive</th>
                  <th>Date depart</th>
                  <th>Ticket</th>
                </tr>
                <xsl:for-each select="/gestion_trains/tickets/ticket[@username=$username]">
                  <xsl:variable name="id_voyage">
                      <xsl:value-of select="@id_voyage"/>
                  </xsl:variable>
                  <tr>
                    <td>
                      <xsl:value-of select="@id_ticket"/>
                    </td>
                    <td>
                      <xsl:variable name="gdepart">
                        <xsl:value-of select="/gestion_trains/voyages/voyage[@id_voyage=$id_voyage]/@gare_depart"></xsl:value-of>
                      </xsl:variable>
                      <xsl:value-of select="/gestion_trains/gares/gare[@id_gare = $gdepart]/ville"/>
                    </td>
                    <td>
                      <xsl:variable name="garrive">
                        <xsl:value-of select="/gestion_trains/voyages/voyage[@id_voyage=$id_voyage]/@gare_arrive"></xsl:value-of>
                      </xsl:variable>
                      <xsl:value-of select="/gestion_trains/gares/gare[@id_gare = $garrive]/ville"/>
                    </td>
                    <td>
                      <xsl:value-of select="/gestion_trains/voyages/voyage[@id_voyage=$id_voyage]/date_dep"/>
                    </td>
                    <td>
                      <a target="_blank">
                        <xsl:attribute name="href">
                          <xsl:text>ticket_view.php?id_ticket=</xsl:text>
                          <xsl:value-of select="@id_ticket"/>
                        </xsl:attribute>
                        Voir
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
