<?php


// Tokenisation - Fonction de filtrage : Changement de la fonction avec la ligne $tab[] = trim($tok); avec la fonction trim()
function explode_bis($source_, $separateurs_) {
  /*$chaine = "Bonjour tout le monde";
  $var_tab_mots = explode(" ", $chaine);
  foreach ($var_tab_mots as $key => $mot) {
    echo $key . " : " . $mot . "<br />";
  }*/
  $tab = array();

  $tok = strtok ( $source_, $separateurs_);

  while ( $tok !== false ) {
    if(strlen($tok) > 2) {
      $tab[] = trim($tok);
    }
    $tok = strtok($separateurs_);
  }
  return $tab;
}

// Fonction d'affichage d'un tableau associatif :
function print_tab($tab_mots_) {
    foreach ($tab_mots_ as $key => $value) {
      echo $key . " : " . $value . "<br />";
    }
}

// Extraction des balises meta HTML
function get_meta_keywords_et_description($source_) {
    // Les metas keywords et description
    $tableau = get_meta_tags($source_);

    return strtolower($tableau["keywords"]) . "<br />" . strtolower($tableau["description"]);
}

// Extraction d'un titre d'un HTML
// Le s c'est pour space , on ignore le retour à la ligne
// le i c'est pour insensible à la casse , on prend aussi les majuscules : <TITLE>
function get_title($sourceHTML_) {
  $chaine = implode(file($sourceHTML_), " ");
  $modele = "/<title>(.*)<\/title>/si";

  preg_match($modele, $chaine, $le_titre);
  // Retourne le contenu et non le modèle
  return $le_titre[1];
}

// Récupération du <body> d'un fichier HTML - Changement de la ligne: $body_contenu = strtolower($le_body[1]); avec strtolower
function get_body($_sourceHTML_) {
    // Découpe le fichier HTML en Chaine de mots espacés une seule fois
    // Il est possible de faire file(http://)
    $chaine = implode(file($_sourceHTML_), " ");

    // Récupération du body
    $modele = '/<body[^>]*>(.*)<\/body>/is';
    preg_match($modele, $chaine, $le_body);

    // Récupération des items texte
    $body_contenu = strtolower($le_body[1]);

    // Supprime les balises JavaScript
    $body_sans_script = strip_javascript($body_contenu);

    // Enlève toutes les balises
    return strip_tags($body_sans_script);
}

function strip_javascript($contenu) {
  $modele_balises_scripts = '/<script[^>]*?>.*?<\/script>/is';
  $contenu_sans_script_javascript = preg_replace($modele_balises_scripts, '', $contenu);
  return $contenu_sans_script_javascript;
}
//extraction des keywords et description des metas html
function get_keywords_description($source_html)
{
	//les  metas keywords +description
	$tab_metas = get_meta_tags($source_html);
	return $tab_metas["keywords"]. " " . $tab_metas["description"];
}

function occurrences2poids($tab, $coefficient) {
  foreach ($tab as $key => $value) {
      $tab[$key] *= $coefficient;
  }
  return $tab;
}

function fusion_deux_tableaux($tab_head, $tab_body) {
    foreach ($tab_head as $mot => $occurrence) {
        if(array_key_exists($mot, $tab_body)) {
          $tab_body[$mot] += $occurrence;
        } else {
            $tab_body[$mot] = $occurrence;
        }
    }
    return $tab_body;
}

?>
