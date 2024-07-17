function recherche(recherche) {
    for (i = 0 ; i < document.getElementsByClassName('quelchantier').length ; i++){
        let source = document.getElementsByClassName('quelchantier')[i].classList.toString();
        source = source.replace('quelchantier ', '');
        source = source.toLowerCase();
        if (source.indexOf(recherche.toLowerCase()) < 0){
            document.getElementsByClassName('quelchantier')[i].style.display = 'none';
        } else {
            document.getElementsByClassName('quelchantier')[i].style.display = 'block';
        }
    }
}

function filtrer(recherche) {
    for (i = 0 ; i < document.getElementsByClassName('quelproduit').length ; i++){
        let source = document.getElementsByClassName('quelproduit')[i].classList.toString();
        source = source.replace('quelproduit ', '');
        source = source.toLowerCase();
        if (source.indexOf(recherche.toLowerCase()) < 0){
            document.getElementsByClassName('quelproduit')[i].style.display = 'none';
        } else {
            document.getElementsByClassName('quelproduit')[i].style.display = 'block';
        }
    }
}

/*Heures*/
function heures() {
    document.getElementById('logo_chantier').style.display = 'flex';
    document.getElementById('rechercher').style.display = 'none';
    document.getElementById('logo_heures').style.display = 'none';
    document.getElementById('logo_trier_az').style.display = 'none';
    document.getElementById('logo_trier_date').style.display = 'none';
    document.getElementById('chargement').style.display = 'flex';
    $.ajax({
        type: 'POST',
        url: 'Horraires/heures.php',
        contentType: false,
        processData: false,
        success:function(response) {
            document.getElementById('chantiers').innerHTML = response;
        }
    });
    document.getElementById('chargement').style.display = 'none';
}

function maj_heure(date){
    debutMatin = document.getElementById('debutMatin' + date).value;
    finMatin = document.getElementById('finMatin' + date).value;
    debutSoir = document.getElementById('debutSoir' + date).value;
    finSoir = document.getElementById('finSoir' + date).value;
    if (finMatin < debutMatin || finSoir < debutSoir){
        alert("heure impossible");
    } else {
        var form_data = new FormData();                  
        form_data.append('date', date);
        form_data.append('debutMatin', debutMatin);
        form_data.append('finMatin', finMatin);
        form_data.append('debutSoir', debutSoir);
        form_data.append('finSoir', finSoir);
        $.ajax({
            type: 'POST',
            url: 'Heures/save_heures.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
    
            }
        });
    }
}

function valider_heure(user, date){
    var form_data = new FormData();                  
    form_data.append('user', user);
    form_data.append('date', date);
    $.ajax({
        type: 'POST',
        url: 'Heures/valider.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {

        }
    });
}

/*Articles*/
/*function articles() {
    document.getElementById('logo_chantier').style.display = 'flex';
    document.getElementById('rechercher').style.display = 'none';
    document.getElementById('logo_articles').style.display = 'none';
    document.getElementById('logo_trier_az').style.display = 'none';
    document.getElementById('logo_trier_date').style.display = 'none';
    document.getElementById('chargement').style.display = 'flex';
    $.ajax({
        type: 'POST',
        url: 'Produits/Nomen.php',
        contentType: false,
        processData: false,
        success:function(response) {
            document.getElementById('chantiers').innerHTML = response;
        }
    });
    document.getElementById('chargement').style.display = 'none';
}*/

/*Paramètres*/
/*function parametres() {
    document.getElementById('logo_chantier').style.display = 'flex';
    document.getElementById('rechercher').style.display = 'none';
    document.getElementById('logo_parametres').style.display = 'none';
    document.getElementById('logo_trier_az').style.display = 'none';
    document.getElementById('logo_trier_date').style.display = 'none';
    document.getElementById('chargement').style.display = 'flex';
    $.ajax({
        type: 'POST',
        url: 'Parametres/parametres.php',
        contentType: false,
        processData: false,
        success:function(response) {
            document.getElementById('chantiers').innerHTML = response;
        }
    });
    document.getElementById('chargement').style.display = 'none';
}*/

/*Liste de chantiers*/
function liste_chantier(trier) {
    var form_data = new FormData();                  
    form_data.append('trier', trier);
    document.getElementById('chargement').style.display = 'flex';
    $.ajax({
        type: 'POST',
        url: 'Chantiers/liste_chantier.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('corps').innerHTML = response;
        }
    });
    document.getElementById('chargement').style.display = 'none';
}

function connect() {
    var userhr = document.getElementById('userhr').value;
    var passhr = document.getElementById('passhr').value;
    var form_data = new FormData();                  
    form_data.append('userhr', userhr);
    form_data.append('passhr', passhr);
    $.ajax({
        type: 'POST',
        url: 'connect.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            if (response == 'Ok'){
                liste_chantier("alpha");
            } else {
                alert('Connection impossible');
                liste_chantier("alpha");
            }
        }
    });
}

function deconnection() {
    $.ajax({
        type: 'POST',
        url: 'deconnection.php',
        contentType: false,
        processData: false,
        success:function(response) {
            liste_chantier("alpha");
        }
    });
}

function new_chantier(categorie){
    document.getElementById('new_chantier').style.display = 'flex';
    document.getElementById('new_chantier').innerHTML = `
    <div class='new_chantier_box'>
        <div id='new_chantier_box_titre' class='new_chantier_box_titre titrenewchantier${categorie}';>
            <div id='new_chantier_box_titre_titre' class='new_chantier_box_titre_titre'>Créer un chantier</div>
            <i class='fa-regular fa-rectangle-xmark fa-xl'
            onclick='close_new_chantier()'></i>
        </div>
        <div class='new_chantier_box_text'>
            <input type='text' id='client' value='' title='Nom du client' placeholder='Nom du client'
            onKeypress='return valid_mail(event)'>
            <input type='text' id='chantier' value='' title='Nature du chantier' placeholder='Nature du chantier'
            onKeypress='return valid_mail(event)'>
            <input type='button' id='add_new_chantier' value='Créer ce chantier' class='connection_button'
            onclick='check_new_chantier(${categorie})'>
        </div>
    </div>
    `
}

function check_new_chantier(statut){
    let client = document.getElementById('client').value;
    let chantier = document.getElementById('chantier').value;
    var form_data = new FormData();
    form_data.append('client', client);
    form_data.append('chantier', chantier);
    form_data.append('statut', statut);
    $.ajax({
        type: 'POST',
        url: 'Chantiers/check_new_chantier.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            if (response == ''){
                add_new_chantier(client, chantier, statut, '');
            } else {
                document.getElementById('new_chantier').innerHTML = `
                <div class='new_chantier_box'>
                    <div id='new_chantier_box_titre' class='new_chantier_box_titre titrenewchantier${statut}';>
                        <div id='new_chantier_box_titre_titre' class='new_chantier_box_titre_titre'>Créer un chantier</div>
                        <i class='fa-regular fa-rectangle-xmark fa-xl'
                        onclick='close_new_chantier()'></i>
                    </div>
                    <div class='new_chantier_box_text'>
                        <input type='text' id='client' value='${client}' readonly>
                        <input type='text' id='chantier' value='${chantier}' readonly>
                    </div>
                    <div class='new_chantier_box_text' style='max-height: calc(100svh - 300px); overflow-y: scroll;'>
                        <input type='button' value='Nouveau client' class='connection_button'
                        onclick='add_new_chantier("${client}", "${chantier}", "${statut}", "")'>
                        ${response}
                    </div>
                </div>
                `
            }
        }
    });
}

function add_new_chantier(client, chantier, statut, IDChantier){
    document.getElementById('new_chantier').style.display = 'none';
    var form_data = new FormData();
    form_data.append('client', client);
    form_data.append('chantier', chantier);
    form_data.append('statut', statut);
    form_data.append('IDChantier', IDChantier);
    $.ajax({
        type: 'POST',
        url: 'Chantiers/add_new_chantier.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(IDChantier) {
            document.getElementById('new_chantier').innerHTML = '';
            window.location.href = "Chantiers/chantier.php" + "?IDChantier=" + IDChantier;
        }
    });
}

function close_new_chantier(){
    document.getElementById('new_chantier').innerHTML = '';
    document.getElementById('new_chantier').style.display = 'none';
}

function chantier_autres() {
    document.getElementById('chargement').style.display = 'flex';
    $.ajax({
        type: 'POST',
        url: 'Chantiers/autres_chantier.php',
        contentType: false,
        processData: false,
        success:function(response) {
            document.getElementById('chantier25').innerHTML = response;
        }
    });
    document.getElementById('chargement').style.display = 'none';
}

/*Chantier*/
function copier_chantier(IDChantier){
    if (confirm('Etes-vous certain de vouloir copier ce chantier ?') == true) {
        var form_data = new FormData();
        form_data.append('IDChantier', IDChantier);
        $.ajax({
            type: 'POST',
            url: 'copier_chantier.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                window.location.href = "Chantier.php" + "?IDChantier=" + response;
            }
        });
    }
}

function supprimer_chantier(IDChantier){
    if (confirm('Etes-vous certain de vouloir supprimer ce chantier ?') == true) {
        var form_data = new FormData();
        form_data.append('IDChantier', IDChantier);
        $.ajax({
            type: 'POST',
            url: 'supprimer_chantier.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                window.location.href = "../index.php";
            }
        });
    }
}

function save_statut(statut, IDChantier){
    document.getElementById('chargement').style.display = 'flex';
    var form_data = new FormData();                  
    form_data.append('statut', statut);
    form_data.append('IDChantier', IDChantier);
    $.ajax({
        type: 'POST',
        url: '../Details/save_statut.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            console.log(response);
        }
    });
    document.getElementById('chargement').style.display = 'none';
}

function save_entete(IDChantier) {
    document.getElementById('chargement').style.display = 'flex';
    var client = document.getElementById('client').value;
    var chantier = document.getElementById('chantier').value;
    var form_data = new FormData();                  
    form_data.append('IDChantier', IDChantier);
    form_data.append('client', client);
    form_data.append('chantier', chantier);
    $.ajax({
        type: 'POST',
        url: 'save_entete.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {

        }
    });
    document.getElementById('chargement').style.display = 'none';
}

function onglets(onglet) {
    document.getElementById('chargement').style.display = 'flex';
    document.getElementById('details').classList.remove("styledOngletSelect");
    document.getElementById('details').classList.add("styledOnglet");
    document.getElementById('produits').classList.remove("styledOngletSelect");
    document.getElementById('produits').classList.add("styledOnglet");
    document.getElementById('actions').classList.remove("styledOngletSelect");
    document.getElementById('actions').classList.add("styledOnglet");
    document.getElementById('pieces_jointes').classList.remove("styledOngletSelect");
    document.getElementById('pieces_jointes').classList.add("styledOnglet");
    document.getElementById('photos').classList.remove("styledOngletSelect");
    document.getElementById('photos').classList.add("styledOnglet");
    document.getElementById('plans').classList.remove("styledOngletSelect");
    document.getElementById('plans').classList.add("styledOnglet");
    document.getElementById(onglet).classList.remove("styledOnglet");
    document.getElementById(onglet).classList.add("styledOngletSelect");
    let IDChantier = document.getElementById('IDChantier').value;
    let form_data = new FormData();                  
    form_data.append('IDChantier', IDChantier);
    $.ajax({
        type: 'POST',
        url: onglet + '.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('chantier_details').innerHTML = response;
            if (onglet == 'plans'){
                localStorage.clear();
                document.getElementById('chantier_details_plan_canvas').addEventListener('wheel', zoom);
                document.getElementById('chantier_details_plan_canvas').addEventListener('mousedown', mousedown);
                document.getElementById('chantier_details_plan_canvas').addEventListener('mousemove', mousemove);
                document.getElementById('chantier_details_plan_canvas').addEventListener('mouseup', mouseup);
                document.getElementById('chantier_details_plan_canvas').addEventListener('touchstart', touchstart);
                document.getElementById('chantier_details_plan_canvas').addEventListener('touchmove', touchmove);
                document.getElementById('chantier_details_plan_canvas').addEventListener('touchend', touchend);
                    draw_points(IDChantier, '1');
            }
        }
    });
    document.getElementById('chargement').style.display = 'none';
}

function valid_mail(evt) {
    var keyCode = evt.which ? evt.which : evt.keyCode;
    var interdit = '&*?!:;,\t#~"^¨%$£?²¤§%*[]{}<>|\\/`';
    if (interdit.indexOf(String.fromCharCode(keyCode)) >= 0) {
        return false;
    }
}

/*Details*/
function save_details(IDChantier) {
    document.getElementById('chargement').style.display = 'flex';
    var adresse = document.getElementById('adresse').value;
    var telephone = document.getElementById('telephone').value;
    var gsm = document.getElementById('gsm').value;
    var email = document.getElementById('email').value;
    var paye = document.getElementById('paye').value;
    var tva = document.getElementById('tva').value;
    var commentaire = document.getElementById('commentaire').value;
    var administratif = document.getElementById('commentaire_administratif').value;
    var form_data = new FormData();                  
    form_data.append('IDChantier', IDChantier);
    form_data.append('adresse', adresse);
    form_data.append('telephone', telephone);
    form_data.append('gsm', gsm);
    form_data.append('email', email);
    form_data.append('paye', paye);
    form_data.append('tva', tva);
    form_data.append('commentaire', commentaire);
    form_data.append('administratif', administratif);
    $.ajax({
        type: 'POST',
        url: '../Details/save_details.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {

        }
    });
    document.getElementById('chargement').style.display = 'none';
}

/*Produits*/
function new_titre(IDChantier){
    document.getElementById('new_titre').style.display = 'flex';
    document.getElementById('new_titre').innerHTML = `
    <div class='new_titre_box'>
        <div id='new_titre_box_titre' class='new_titre_box_titre';>
            <div id='new_titre_box_titre_titre' class='new_titre_box_titre_titre'>Ajouter un titre</div>
            <i class='fa-regular fa-rectangle-xmark fa-xl'
            onclick='close_new_titre()'></i>
        </div>
        <div class='new_titre_box_text'>
            <input type='text' id='titre' value='' title='Titre' placeholder='Titre'
            onKeypress='return valid_mail(event)'>
            <input type='button' id='add_new_titre' value='Ajouter' class='connection_button'
            onclick='add_new_titre(${IDChantier})'>
        </div>
    </div>
    `
    document.getElementById('titre').focus();
}

function add_new_titre(IDChantier){
    document.getElementById('new_titre').style.display = 'none';
    let titre = document.getElementById('titre').value;
    var form_data = new FormData();
    form_data.append('IDChantier', IDChantier);
    form_data.append('titre', titre);
    $.ajax({
        type: 'POST',
        url: '../Produits/add_new_titre.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('new_titre').innerHTML = '';
            onglets('produits')
        }
    });
}

function close_new_titre(){
    document.getElementById('new_titre').innerHTML = '';
    document.getElementById('new_titre').style.display = 'none';
}

function new_produit(IDChantier, IDTitre, niveau, filtre){
    var form_data = new FormData();                  
    form_data.append('IDChantier', IDChantier);
    form_data.append('IDTitre', IDTitre);
    form_data.append('niveau', niveau);
    form_data.append('filtre', filtre);
    $.ajax({
        type: 'POST',
        url: '../Liste_produits/liste_produits.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('liste_produits').innerHTML = response;
            document.getElementById('liste_produits').style.display = 'flex';
        }
    });
}

function add_produit(IDChantier, IDTitre, IDProduit) {
    var quantite = document.getElementById('quantite' + IDProduit).value;
    var tarif = document.getElementById('tarif' + IDProduit).value;
    if (quantite == ''){
        alert('Veuillez renseigner une quantité');
    } else {
        let maj = false;
        if (confirm("Mettre à jour le tarif de base ?")) {
            maj = true;
        } else {
            maj = false;
        }
        var form_data = new FormData();
        form_data.append('IDChantier', IDChantier);
        form_data.append('IDTitre', IDTitre);
        form_data.append('IDProduit', IDProduit);
        form_data.append('quantite', quantite);
        form_data.append('tarif', tarif);
        form_data.append('maj', maj);
        $.ajax({
            type: 'POST',
            url: '../Liste_produits/add_produit.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                document.getElementById('liste_produits_' + IDProduit).animate([
                    { transform: 'scale(0)' }
                ], {
                    duration: 500,
                });
                onglets('produits');
            }
        });
    }
}

function add_new_arborescence(IDChantier, IDTitre, niveau, filtre) {
    var arborescence = document.getElementById('arborescence').value;
    if (arborescence == ''){
        alert('Veuillez renseigner un titre');
    } else {
        var form_data = new FormData();
        form_data.append('niveau', niveau);
        form_data.append('arborescence', arborescence);
        $.ajax({
            type: 'POST',
            url: '../Liste_produits/add_new_arborescence.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                document.getElementById('liste_produits_new_arborescence').animate([
                    { transform: 'scale(0)' }
                ], {
                    duration: 500,
                });        
                new_produit(IDChantier, IDTitre, niveau, filtre);
            }
        });
    }
}

function add_new_produit(IDChantier, IDTitre, niveau, filtre) {
    var quantite = document.getElementById('quantite').value;
    var unite = document.getElementById('unite').value;
    var designation = document.getElementById('designation').value;
    var tarif = document.getElementById('tarif').value;
    if (quantite == ''){
        alert('Veuillez renseigner une quantité');
    } else if (unite == ''){
        alert('Veuillez renseigner l\'unité de vente');
    } else if (designation == ''){
        alert('Veuillez renseigner le nom du produit');
    } else if (tarif == ''){
        alert('Veuillez renseigner le prix de vente du produit');
    } else {
        var form_data = new FormData();
        form_data.append('niveau', niveau);
        form_data.append('unite', unite);
        form_data.append('designation', designation);
        form_data.append('tarif', tarif);
        $.ajax({
            type: 'POST',
            url: '../Liste_produits/add_new_produit.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(IDProduit) {
                new_produit(IDChantier, IDTitre, niveau, filtre);
                var form_data = new FormData();                  
                form_data.append('IDChantier', IDChantier);
                form_data.append('IDTitre', IDTitre);
                form_data.append('IDProduit', IDProduit);
                form_data.append('quantite', quantite);
                form_data.append('tarif', tarif);
                $.ajax({
                    type: 'POST',
                    url: '../Liste_produits/add_produit.php',
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success:function(response) {
                        document.getElementById('liste_produits_new_produit').animate([
                            { transform: 'scale(0)' }
                        ], {
                            duration: 500,
                        });        
                        onglets('produits');
                    }
                });
            }
        });
    }
}

function copier_titre(IDChantier, IDTitre){
    if (confirm('Etes-vous certain de vouloir copier cette zone ?') == true) {
        var form_data = new FormData();
        form_data.append('IDChantier', IDChantier);
        form_data.append('IDTitre', IDTitre);
        $.ajax({
            type: 'POST',
            url: 'copier_titre.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                onglets('produits')
            }
        });
    }
}

function fermer_liste_produits() {
    document.getElementById('liste_produits').innerHTML = '';
    document.getElementById('liste_produits').style.display = 'none';
}

function save_produit(IDDetails) {
    var quantite = document.getElementById('quantiteprod' + IDDetails).value;
    var remise = document.getElementById('remiseprod' + IDDetails).value;
    var tarif = document.getElementById('tarifprod' + IDDetails).value;
    var form_data = new FormData();                  
    form_data.append('IDDetails', IDDetails);
    form_data.append('quantite', quantite);
    form_data.append('remise', remise);
    form_data.append('tarif', tarif);
    $.ajax({
        type: 'POST',
        url: '../Produits/save_produit.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(IDProduit) {
            if (IDProduit != ''){
                if (confirm('Souhaitez-vous appliquer ce tarif comme nouveau tarif de base ?') == true) {
                    var form_data = new FormData();                  
                    form_data.append('IDProduit', IDProduit);
                    form_data.append('tarif', tarif);
                    $.ajax({
                        type: 'POST',
                        url: '../Produits/MAJ_tarif_produit.php',
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success:function(response) {

                        }
                    });
                }
            }
            onglets('produits');
        }
    });
}

function save_titre(IDTitre, titre) {
    var form_data = new FormData();                  
    form_data.append('IDTitre', IDTitre);
    form_data.append('titre', titre);
    $.ajax({
        type: 'POST',
        url: '../Produits/save_titre.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            onglets('produits');
        }
    });
}

function delete_produit(IDDetails) {
    if (confirm('Etes-vous certain de vouloir supprimer ce produit ?') == true) {
        var form_data = new FormData();                  
        form_data.append('IDDetails', IDDetails);
        $.ajax({
            type: 'POST',
            url: '../Produits/delete_produit.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                onglets('produits');
            }
        });
        fermer_fiche_produit();
    }
}

function delete_titre(IDChantier, IDTitre) {
    if (confirm('Etes-vous certain de vouloir supprimer ce titre ainsi que les produits qu\'il contient ?') == true) {
        var form_data = new FormData();                  
        form_data.append('IDChantier', IDChantier);
        form_data.append('IDTitre', IDTitre);
        $.ajax({
            type: 'POST',
            url: '../Produits/delete_titre.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                onglets('produits');
            }
        });
    }
}

function valid_number(evt) {
    var keyCode = evt.which ? evt.which : evt.keyCode;
    var autorise = '0123456789.';
    if (autorise.indexOf(String.fromCharCode(keyCode)) < 0) {
        return false;
    }
}

function afficher_produit(IDDetails){
    document.getElementById('fiche_produit').style.display = 'flex';
    var form_data = new FormData();
    form_data.append('IDDetails', IDDetails);
    $.ajax({
        type: 'POST',
        url: '../Produits/afficher_produit.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('fiche_produit').innerHTML = response;
        }
    });
}

function fermer_fiche_produit(){
    document.getElementById('fiche_produit').innerHTML = '';
    document.getElementById('fiche_produit').style.display = 'none';
}

function save_commentaire(IDDetails, commentaires) {
    document.getElementById('chargement').style.display = 'flex';
    var form_data = new FormData();                  
    form_data.append('IDDetails', IDDetails);
    form_data.append('commentaires', commentaires);
    $.ajax({
        type: 'POST',
        url: '../Produits/save_commentaires.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {

        }
    });
    document.getElementById('chargement').style.display = 'none';
}

function avancement(IDDetails, avancement) {
    document.getElementById('chargement').style.display = 'flex';
    document.getElementById('avancement_visuel').value = avancement;
    document.getElementById('detailprod' + IDDetails).style.background = 'linear-gradient(90deg, green ' + avancement + '%, #b3b3b3 0%)';
    var form_data = new FormData();                  
    form_data.append('IDDetails', IDDetails);
    form_data.append('avancement', avancement);
    $.ajax({
        type: 'POST',
        url: '../Produits/save_avancement.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {

        }
    });
    document.getElementById('chargement').style.display = 'none';
}

function maj_avancement(IDDetails, etat) {
    if (etat == 1) {
        if (document.getElementById('avancement').value <= 10) {
            document.getElementById('avancement').value = 0;
        } else {
            document.getElementById('avancement').value = document.getElementById('avancement').value - 10;
        }
    } else if (etat == 2) {
        if (document.getElementById('avancement').value >= 90) {
            document.getElementById('avancement').value = 100;
        } else {
            document.getElementById('avancement').value = document.getElementById('avancement').value - 10 + 20;
        }
    } else if (etat == 3) {
        document.getElementById('avancement').value = 100;
    }
    avancement(IDDetails, document.getElementById('avancement').value);
}

function save_fiche_produit(IDDetails) {
    var quantite = document.getElementById('quantiteproduit' + IDDetails).value;
    var remise = document.getElementById('remiseproduit' + IDDetails).value;
    var tarif = document.getElementById('tarifproduit' + IDDetails).value;
    let prixremise = (100 - remise) / 100 * tarif;
    document.getElementById('prixremise').innerText = prixremise.toFixed(2);
    var form_data = new FormData();                  
    form_data.append('IDDetails', IDDetails);
    form_data.append('quantite', quantite);
    form_data.append('remise', remise);
    form_data.append('tarif', tarif);
    $.ajax({
        type: 'POST',
        url: '../Produits/save_produit.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(IDProduit) {
            if (IDProduit != ''){
                if (confirm('Souhaitez-vous appliquer ce tarif comme nouveau tarif de base ?') == true) {
                    var form_data = new FormData();                  
                    form_data.append('IDProduit', IDProduit);
                    form_data.append('tarif', tarif);
                    $.ajax({
                        type: 'POST',
                        url: '../Produits/MAJ_tarif_produit.php',
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success:function(response) {

                        }
                    });
                }
            }
            onglets('produits');
        }
    });
}

function afficher(){
    document.getElementById('masquer_afficher').style.display = 'none';
    document.getElementById('afficher_masquer').style.display = 'flex';
}

function masquer(){
    document.getElementById('masquer_afficher').style.display = 'flex';
    document.getElementById('afficher_masquer').style.display = 'none';
}

function deplacer_produits(IDChantier, IDDetails) {
    let form_data = new FormData();                  
    form_data.append('IDChantier', IDChantier);
    form_data.append('IDDetails', IDDetails);
    $.ajax({
        type: 'POST',
        url: '../Produits/deplacer_produits.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('chantier_details').innerHTML = response;
        }
    });
    document.getElementById('chargement').style.display = 'none';
}

function deplacer_produit(IDDetails, IDChantier, IDTitre, IDPosition) {
    let form_data = new FormData();                  
    form_data.append('IDDetails', IDDetails);
    form_data.append('IDChantier', IDChantier);
    form_data.append('IDTitre', IDTitre);
    form_data.append('IDPosition', IDPosition);
    $.ajax({
        type: 'POST',
        url: '../Produits/deplacer_produit.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            onglets('produits');
        }
    });
    document.getElementById('chargement').style.display = 'none';
}

/*action*/
function new_action(IDChantier){
    var date = new Date()
    var annee = date.getFullYear();
    var mois = '0' + (date.getMonth()+1);
    var mois = mois.substr(-2);
    var jour = '0' + date.getDate();
    var jour = jour.substr(-2);
    var heure = '0' + date.getHours();
    var heure = heure.substr(-2);
    var minute = '0' + date.getMinutes();
    var minute = minute.substr(-2);
    var Aujourdhui = annee + "-" + mois + "-" + jour + "T" + heure + ":" + minute;
    document.getElementById('new_action').style.display = 'flex';
    document.getElementById('new_action').innerHTML = `
    <div class='new_action_box'>
        <div id='new_action_box_titre' class='new_action_box_titre titrenewchantier${IDChantier}';>
            <div id='new_action_box_titre_titre' class='new_action_box_titre_titre'>Créer une action</div>
            <i class='fa-regular fa-rectangle-xmark fa-xl'
            onclick='close_new_action()'></i>
        </div>
        <div class='new_action_box_text'>
            <input type='datetime-local' id='date_action' value='${Aujourdhui}'
            onKeypress='return valid_mail(event)'>
            <select id='type_action'>
                <option value='Appel reçu'>Appel reçu</option>
                <option value='Appel passé'>Appel passé</option>
                <option value='Email reçu'>Email reçu</option>
                <option value='Email envoyé'>Email envoyé</option>
                <option value='SMS reçu'>SMS reçu</option>
                <option value='SMS envoyé'>SMS envoyé</option>
                <option value='RDV fait'>RDV fait</option>
                <option value='Appeler'>Appeler</option>
                <option value='Envoyer mail'>Envoyer mail</option>
                <option value='Envoyer SMS'>Envoyer SMS</option>
                <option value='RDV'>RDV</option>
                <option value='Autres'>Autres</option>
            </select>
            <input type='text' id='commentaire_action' value='' title='Commentaire action' placeholder='Commentaire action'
            onKeypress='return valid_mail(event)'>
        </div>
        <div class='new_action_box_button'>
            <input type='button' id='add_new_action' value='Créer cette action' class='connection_button'
            onclick='add_new_action(${IDChantier})'>
        </div>
    </div>
    `
    document.getElementById('commentaire_action').focus();
}

function add_new_action(IDChantier){
    let commentaire = document.getElementById('commentaire_action').value;
    if (commentaire == ''){
        alert('Veuillez saisir un commentaire à cette action');
    } else {
        document.getElementById('new_action').style.display = 'none';
        let date = document.getElementById('date_action').value;
        let type = document.getElementById('type_action').value;
        var form_data = new FormData();
        form_data.append('IDChantier', IDChantier);
        form_data.append('date', date);
        form_data.append('type', type);
        form_data.append('commentaire', commentaire);
        $.ajax({
            type: 'POST',
            url: '../Actions/add_new_action.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                onglets('actions');
            }
        });
    }
}

function close_new_action(){
    document.getElementById('new_action').innerHTML = '';
    document.getElementById('new_action').style.display = 'none';
}

/*PJ*/
function parcourir_PJ(IDChantier) {
    document.getElementById('chargement').style.display = 'flex';
    document.getElementById('fichier_PJ' + IDChantier).click();
    document.getElementById('fichier_PJ' + IDChantier).onchange = function() {
        for (let i = 0; i < document.getElementById('fichier_PJ' + IDChantier).files.length; i++) {
            fichier = document.getElementById('fichier_PJ' + IDChantier).files[i];
            envoi_PJ(fichier, IDChantier);
        }
    };
    document.getElementById('chargement').style.display = 'none';
}

function envoi_PJ(fichier, IDChantier) {
    document.getElementById('chargement').style.display = 'flex';
    if(fichier != undefined) {
        var form_data = new FormData();
        form_data.append('file', fichier);
        form_data.append('IDChantier', IDChantier);
        $.ajax({
            type: 'POST',
            url: '../PJ/envoi_PJ.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                //alert(response);
                onglets('pieces_jointes');
            }
        });
    }
    document.getElementById('chargement').style.display = 'none';
}

function supprimer_PJ(id){
    if (confirm("Supprimer la pièce jointe ?")) {
        document.getElementById('chargement').style.display = 'flex';
        var form_data = new FormData();
        form_data.append('id', id);
        $.ajax({
            type: 'POST',
            url: '../PJ/supprimer_PJ.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                onglets('pieces_jointes');
            }
        });
        document.getElementById('chargement').style.display = 'none';
    }
}

/*Photos*/
function parcourir_photo(IDChantier) {
    document.getElementById('chargement').style.display = 'flex';
    document.getElementById('fichier_photo' + IDChantier).click();
    document.getElementById('fichier_photo' + IDChantier).onchange = function() {
        for (let i = 0; i < document.getElementById('fichier_photo' + IDChantier).files.length; i++) {
            fichier = document.getElementById('fichier_photo' + IDChantier).files[i];
            envoi_photo(fichier, IDChantier);
        }
    };
    document.getElementById('chargement').style.display = 'none';
}

function envoi_photo(fichier, IDChantier) {
    document.getElementById('chargement').style.display = 'flex';
    if(fichier != undefined) {
        var form_data = new FormData();
        form_data.append('file', fichier);
        form_data.append('IDChantier', IDChantier);
        $.ajax({
            type: 'POST',
            url: '../Photos/envoi_photo.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                onglets('photos');
            }
        });
    }
    document.getElementById('chargement').style.display = 'none';
}

function supprimer_photo(id){
    if (confirm("Supprimer la photo ?")) {
        document.getElementById('chargement').style.display = 'flex';
        var form_data = new FormData();
        form_data.append('id', id);
        $.ajax({
            type: 'POST',
            url: '../Photos/supprimer_photo.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                onglets('photos');
            }
        });
        document.getElementById('chargement').style.display = 'none';
        document.getElementById('afficher_photo').innerHTML = '';
        document.getElementById('afficher_photo').style.display = 'none';
    }
}

function afficher_photo(id){
    document.getElementById('chargement').style.display = 'flex';
    var form_data = new FormData();
    form_data.append('id', id);
    $.ajax({
        type: 'POST',
        url: '../Photos/afficher_photo.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('afficher_photo').style.display = 'flex';
            document.getElementById('afficher_photo').innerHTML = response;
            document.getElementById('chargement').style.display = 'none';
        }
    });
}

function fermer_photo(){
    document.getElementById('afficher_photo').innerHTML = '';
    document.getElementById('afficher_photo').style.display = 'none';
}

/*Plans*/
function charger_plan(IDChantier, IDPlan) {
    document.getElementById('IDPlan').value = IDPlan;
    let form_data = new FormData();                  
    form_data.append('IDChantier', IDChantier);
    form_data.append('IDPlan', IDPlan);
    $.ajax({
        type: 'POST',
        url: 'Plans.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('chantier_details').innerHTML = response;
            document.getElementById('chantier_details_plan_canvas').addEventListener('wheel', zoom);
            document.getElementById('chantier_details_plan_canvas').addEventListener('mousedown', mousedown);
            document.getElementById('chantier_details_plan_canvas').addEventListener('mousemove', mousemove);
            document.getElementById('chantier_details_plan_canvas').addEventListener('mouseup', mouseup);
            document.getElementById('chantier_details_plan_canvas').addEventListener('touchstart', touchstart);
            document.getElementById('chantier_details_plan_canvas').addEventListener('touchmove', touchmove);
            document.getElementById('chantier_details_plan_canvas').addEventListener('touchend', touchend);
            draw_points(IDChantier, IDPlan);
        }
    });
    document.getElementById('chargement').style.display = 'none';
}

function draw_points(IDChantier, IDPlan) {
    var form_data = new FormData();                  
    form_data.append('IDChantier', IDChantier);
    form_data.append('IDPlan', IDPlan);
    $.ajax({
        type: 'POST',
        url: '../Plans/points.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            let obj = JSON.parse(response);
            document.getElementById('chantier_details_plan_canvas').innerHTML = '';
            let liste = [];
            for (let i = 0; i < obj.length; i++) {
                let IDPoint = obj[i]['IDPoint'];
                let nbpoint = obj[i]['nbpoint'];
                let x = obj[i]['x'];
                let y = obj[i]['y'];
                let IDEtat = obj[i]['IDEtat'];
                let IDFamille = obj[i]['IDFamille'];
                let colorEtat = obj[i]['colorEtat'];
                liste.push(IDPoint);
                draw_exist(IDPoint, obj.length, x, y, nbpoint, IDEtat, IDFamille, colorEtat);
            }
            localStorage.setItem('points', liste);
            cadre_position();
        }
    });
}

function draw_exist(IDPoint, dernierpoint, x, y, nbpoint, IDEtat, IDFamille, colorEtat) {
    var canvasx = document.getElementById('chantier_details_plan_canvas').clientWidth;
    var canvasy = document.getElementById('chantier_details_plan_canvas').clientHeight;
    var largeur = 30;
    var hauteur = 47;
    var newDiv = document.createElement("div");
    newDiv.style.position = 'absolute';
    newDiv.style.backgroundImage = 'url(../Images/Lieu' + colorEtat + '.png)';
    newDiv.style.backgroundSize = 'contain';
    newDiv.innerHTML = nbpoint;
    newDiv.style.backgroundRepeat = 'no-repeat';
    newDiv.style.width = largeur + 'px';
    newDiv.style.height = hauteur + 'px';
    newDiv.style.top = (y * canvasy / 100) - (hauteur) + 22 + 'px';
    newDiv.style.left = (x * canvasx / 100) - (largeur / 2) + 'px';
    newDiv.style.fontWeight = 'bold';
    newDiv.style.display = 'flex';
    newDiv.style.justifyContent = 'center';
    newDiv.style.alignItems = 'flex-start';
    newDiv.style.flexWrap = 'nowrap';
    newDiv.style.paddingTop = '5px';
    newDiv.style.color = colorEtat;
    newDiv.classList.add('IDEtat' + IDEtat);
    newDiv.classList.add('IDFamille' + IDFamille);
    newDiv.setAttribute("onclick","menu_point(" + IDPoint + ");");
    newDiv.id = 'IDPoint' + IDPoint;
    var chantier_details_plan = document.getElementById('chantier_details_plan');
    var canvas = document.getElementById('chantier_details_plan_canvas');
    canvas.appendChild(newDiv);
    document.getElementById('dernierpoint').value = dernierpoint;
    document.getElementById('IDPoint' + IDPoint).addEventListener('wheel', zoom);
}

function menu_point(IDPoint) {
    var form_data = new FormData();                  
    form_data.append('IDPoint', IDPoint);
    $.ajax({
        type: 'POST',
        url: '../Plans/afficher_point.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('chantier_details_point').innerHTML = response;
            document.getElementById('chantier_details_point').style.display = 'flex';
        }
    });
}

function creer_point() {
    let mouseclicx = document.getElementById('mouseclicx').value;
    let mouseclicy = document.getElementById('mouseclicy').value;
    let top = Number(document.getElementById('chantier_details_plan_canvas').style.top.replace('px', ''));
    let left = Number(document.getElementById('chantier_details_plan_canvas').style.left.replace('px', ''));
    let width = Number(document.getElementById('chantier_details_plan_canvas').style.width.replace('px', ''));
    let height = Number(document.getElementById('chantier_details_plan_canvas').style.height.replace('px', ''));
    let x = (mouseclicx - left) / width * 100;
    let y = (mouseclicy - top - 188) / height * 100;
    if (document.getElementById('nompoint').value != ''){
        let IDChantier = document.getElementById('IDChantier').value;
        let IDPlan = document.getElementById('IDPlan').value;
        let nbpoint = parseInt(document.getElementById('dernierpoint').value) + 1;
        let nompoint = document.getElementById('nompoint').value;
        let IDEtat = document.querySelector('input[name=etat]:checked').value;
        let IDFamille = document.querySelector('input[name=famille]:checked').value;
        let labelFamille = document.getElementById('labelFamille').value;
        let commentaires = document.getElementById('commentaires').value;
        var form_data = new FormData();                  
        form_data.append('IDChantier', IDChantier);
        form_data.append('IDPlan', IDPlan);
        form_data.append('x', x);
        form_data.append('y', y);
        form_data.append('nbpoint', nbpoint);
        form_data.append('nompoint', nompoint);
        form_data.append('IDEtat', IDEtat);
        form_data.append('IDFamille', IDFamille);
        form_data.append('labelFamille', labelFamille);
        form_data.append('commentaires', commentaires);
        $.ajax({
            type: 'POST',
            url: '../Plans/save_point.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                document.getElementById('chantier_details_point').style.display = 'none';
                draw_points(IDChantier, IDPlan);
            }
        });
    } else {
        alert('Veuillez nommer votre point');
        document.getElementById('nompoint').focus();
    }
}

function fermer_point() {
    document.getElementById('chantier_details_point').style.display = 'none';
}

function ouvrir_menu(menu, IDChantier, IDPlan) {
    var form_data = new FormData();
    form_data.append('IDChantier', IDChantier);
    form_data.append('IDPlan', IDPlan);
    let liste_points = [];
    let liste_etats = [];
    let liste_familles = [];
    if (localStorage.length > 0){
        for (let i = 0; i < localStorage.length; i++){
            if (localStorage.key(i) == 'points'){
                liste_points = localStorage.getItem(localStorage.key(i));
            } else if (localStorage.key(i) == 'etats'){
                liste_etats = localStorage.getItem(localStorage.key(i));
            } else if (localStorage.key(i) == 'familles'){
                liste_familles = localStorage.getItem(localStorage.key(i));
            }
        }
    }
    form_data.append('liste_points', liste_points);
    form_data.append('liste_etats', liste_etats);
    form_data.append('liste_familles', liste_familles);
    $.ajax({
        type: 'POST',
        url: '../Plans/' + menu + '.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('chantier_details_point').innerHTML = response;
            document.getElementById('chantier_details_point').style.display = 'flex';
        }
    });
}

function zoom(event) {
    let canvasx = parseFloat(document.getElementById('chantier_details_plan_canvas').clientWidth);
    let canvasy = parseFloat(document.getElementById('chantier_details_plan_canvas').clientHeight);
    let IDChantier = document.getElementById('IDChantier').value;
    let IDPlan = document.getElementById('IDPlan').value;
    event.preventDefault();
    document.getElementById('chantier_details_plan_canvas').style.width = canvasx * (1000 - event.deltaY) * 0.001 + 'px';
    document.getElementById('chantier_details_plan_canvas').style.height = canvasy * (1000 - event.deltaY) * 0.001 + 'px';
    document.getElementById('chantier_details_plan_canvas').innerHTML = '';
    draw_points(IDChantier, IDPlan);
    cadre_position();
}

function mousedown(event) {
    document.getElementById('mousedebutx').value = event.x - document.getElementById('chantier_details_plan_canvas').style.left.replace('px', '');
    document.getElementById('mousedebuty').value = event.y - document.getElementById('chantier_details_plan_canvas').style.top.replace('px', '');
    document.getElementById('mouseclicx').value = event.x;
    document.getElementById('mouseclicy').value = event.y;
}

function mouseup(event) {
    document.getElementById('mousedebutx').value = 0;
    document.getElementById('mousedebuty').value = 0;
}

function mousemove(event) {
    var largeur = 30;
    var hauteur = 47;
    if (document.getElementById('mousedebutx').value != 0){
        cadre_position();
        document.getElementById('chantier_details_plan_canvas').style.left = (event.x - document.getElementById('mousedebutx').value) + 'px';
        document.getElementById('chantier_details_plan_canvas').style.top = (event.y - document.getElementById('mousedebuty').value) + 'px';
        for (let i = 1; i <= document.getElementById('dernierpoint').value; i++) {
            var canvasscale = Number(document.getElementById('chantier_details_plan_canvas').style.scale);
            var canvasleft = Number(document.getElementById('chantier_details_plan_canvas').style.left.replace('px', ''));
            var canvastop = Number(document.getElementById('chantier_details_plan_canvas').style.top.replace('px', ''));
            var nbpointx = Number(document.getElementById('nbpointx' + i).value);
            var nbpointy = Number(document.getElementById('nbpointy' + i).value);
            var canvaswidth = Number(document.getElementById('chantier_details_plan_canvas').width);
            var canvasheight = Number(document.getElementById('chantier_details_plan_canvas').height);
            document.getElementById('nbpoint' + i).style.left = canvasleft + canvasscale * (nbpointx - largeur / 2) + (canvaswidth / 2 * (1 - canvasscale)) + 'px';
            document.getElementById('nbpoint' + i).style.width = canvasscale * largeur + 'px';
            document.getElementById('nbpoint' + i).style.top = canvastop + canvasscale * (nbpointy - hauteur) + (canvasheight / 2 * (1 - canvasscale)) + 'px';
            document.getElementById('nbpoint' + i).style.height = canvasscale * hauteur + 'px';
        }
    }
}

let initialTouchDistanceX = null;
let initialTouchDistanceY = null;
let touchDistance = 0;

function touchstart(event) {
    /*event.preventDefault();*/
    if (event.touches.length === 2) {
        initialTouchDistanceX = Math.abs(event.touches[1].pageX - event.touches[0].pageX);
        initialTouchDistanceY = Math.abs(event.touches[1].pageY - event.touches[0].pageY);
    } else {
        document.getElementById('mousedebutx').value = event.changedTouches[0].pageX - document.getElementById('chantier_details_plan_canvas').style.left.replace('px', '');
        document.getElementById('mousedebuty').value = event.changedTouches[0].pageY - document.getElementById('chantier_details_plan_canvas').style.top.replace('px', '');
        document.getElementById('mouseclicx').value = event.changedTouches[0].pageX;
        document.getElementById('mouseclicy').value = event.changedTouches[0].pageY;
    }
}

function touchmove(event) {
    event.preventDefault();
    if (event.touches.length === 2 && initialTouchDistanceX !== null && initialTouchDistanceY !== null) {
        const touchDistanceX = Math.abs(event.touches[1].pageX - event.touches[0].pageX) - initialTouchDistanceX;
        const touchDistanceY = Math.abs(event.touches[1].pageY - event.touches[0].pageY) - initialTouchDistanceY;
        initialTouchDistanceX = Math.abs(event.touches[1].pageX - event.touches[0].pageX);
        initialTouchDistanceY = Math.abs(event.touches[1].pageY - event.touches[0].pageY);
        if (Math.abs(touchDistanceX) > Math.abs(touchDistanceY)){
            touchDistance = touchDistanceX;
        } else {
            touchDistance = touchDistanceY;
        }
        let canvasx = parseFloat(document.getElementById('chantier_details_plan_canvas').clientWidth);
        let canvasy = parseFloat(document.getElementById('chantier_details_plan_canvas').clientHeight);
        let IDChantier = document.getElementById('IDChantier').value;
        let IDPlan = document.getElementById('IDPlan').value;
        document.getElementById('chantier_details_plan_canvas').style.width = canvasx + 2 * touchDistance + 'px';
        document.getElementById('chantier_details_plan_canvas').style.height = canvasy / canvasx * (canvasx + 2 * touchDistance) + 'px';
        document.getElementById('chantier_details_plan_canvas').innerHTML = '';
        draw_points(IDChantier, IDPlan);
        cadre_position();
    } else {
        var largeur = 30;
        var hauteur = 47;
        if (document.getElementById('mousedebutx').value != 0){
            cadre_position();
            document.getElementById('chantier_details_plan_canvas').style.left = (event.changedTouches[0].pageX - document.getElementById('mousedebutx').value) + 'px';
            document.getElementById('chantier_details_plan_canvas').style.top = (event.changedTouches[0].pageY - document.getElementById('mousedebuty').value) + 'px';
            for (let i = 1; i <= document.getElementById('dernierpoint').value; i++) {
                var canvasscale = Number(document.getElementById('chantier_details_plan_canvas').style.scale);
                var canvasleft = Number(document.getElementById('chantier_details_plan_canvas').style.left.replace('px', ''));
                var canvastop = Number(document.getElementById('chantier_details_plan_canvas').style.top.replace('px', ''));
                var nbpointx = Number(document.getElementById('nbpointx' + i).value);
                var nbpointy = Number(document.getElementById('nbpointy' + i).value);
                var canvaswidth = Number(document.getElementById('chantier_details_plan_canvas').width);
                var canvasheight = Number(document.getElementById('chantier_details_plan_canvas').height);
                document.getElementById('nbpoint' + i).style.left = canvasleft + canvasscale * (nbpointx - largeur / 2) + (canvaswidth / 2 * (1 - canvasscale)) + 'px';
                document.getElementById('nbpoint' + i).style.width = canvasscale * largeur + 'px';
                document.getElementById('nbpoint' + i).style.top = canvastop + canvasscale * (nbpointy - hauteur) + (canvasheight / 2 * (1 - canvasscale)) + 'px';
                document.getElementById('nbpoint' + i).style.height = canvasscale * hauteur + 'px';
            }
        }
    }
}

function touchend(event) {
    initialTouchDistanceX = null;
    initialTouchDistanceY = null;
    /*event.preventDefault();*/
    document.getElementById('mousedebutx').value = 0;
    document.getElementById('mousedebuty').value = 0;
}

function cadre_position() {
    let topref = 142;
    document.getElementById('cadre_position').style.display = 'flex';
    document.getElementById('cadre_rouge').style.display = 'flex';
    let canvastop = parseFloat(document.getElementById('chantier_details_plan_canvas').offsetTop);
    let canvasleft = parseFloat(document.getElementById('chantier_details_plan_canvas').offsetLeft);
    let cadrex = parseFloat(document.getElementById('cadre_position').clientWidth);
    let taillephoto = parseFloat(document.getElementById('taillephoto').value);
    document.getElementById('cadre_position').style.height = cadrex * taillephoto + 'px';
    let cadrey = parseFloat(document.getElementById('cadre_position').clientHeight);
    let canvasx = parseFloat(document.getElementById('chantier_details_plan_canvas').clientWidth);
    let canvasy = parseFloat(document.getElementById('chantier_details_plan_canvas').clientHeight);
    let pagex = parseFloat(document.getElementById('chantier_details_plan').clientWidth);
    let pagey = parseFloat(document.getElementById('chantier_details_plan').clientHeight);
    document.getElementById('cadre_position').style.top = topref + 'px';
    document.getElementById('cadre_position').style.left = pagex - cadrex + 'px';
    let correctionheight = 0;
    let correctiontop = canvastop / canvasy * cadrey;
    if (canvastop / canvasy * cadrey > 0){
        correctionheight = canvastop / canvasy * cadrey;
        correctiontop = 0;
    } else {
        correctionheight = 0;
        correctiontop = canvastop / canvasy * cadrey;
    }
    let correctionwidth = 0;
    let correctionleft = canvasleft / canvasx * cadrex;
    if (canvasleft / canvasx * cadrex > 0){
        correctionwidth = canvasleft / canvasx * cadrex;
        correctionleft = 0;
    } else {
        correctionwidth = 0;
        correctionleft = canvasleft / canvasx * cadrex;
    }
    document.getElementById('cadre_rouge').style.top = topref - correctiontop + 'px';
    document.getElementById('cadre_rouge').style.left = pagex - cadrex - correctionleft + 'px';
    document.getElementById('cadre_rouge').style.width = pagex / canvasx * cadrex - correctionwidth + 'px';
    document.getElementById('cadre_rouge').style.height = pagey / canvasx * cadrex - correctionheight + 'px';
    document.getElementById('cadre_rouge').style.maxWidth = cadrex + correctionleft - 4 + 'px';
    document.getElementById('cadre_rouge').style.maxHeight = cadrey + correctiontop - 4 + 'px';
setTimeout(cadre_position_fin, 5000);
}

function cadre_position_fin() {
    //document.getElementById('cadre_position').style.display = 'none';
    //document.getElementById('cadre_rouge').style.display = 'none';
}

function check_point(){
    localStorage.removeItem('etats');
    localStorage.removeItem('familles');
    let IDChantier = document.getElementById('IDChantier').value;
    let IDPlan = document.getElementById('IDPlan').value;
    let point = '';
    let liste = [];
    for (i = 0 ; i < document.getElementsByClassName('checkpoints').length ; i++){
        if (document.getElementById(document.getElementsByClassName('checkpoints')[i].id).checked == false) {
            let lepoint = document.getElementsByClassName('checkpoints')[i].id.replace('checkIDPoint', '');
            point += " AND points.IDPoint <> '" + lepoint + "'";
            liste.push(lepoint);
        }
    }
    localStorage.setItem('points', liste);
    var form_data = new FormData();                  
    form_data.append('IDChantier', IDChantier);
    form_data.append('IDPlan', IDPlan);
    form_data.append('filtre', point);
    $.ajax({
        type: 'POST',
        url: '../Plans/points.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            let obj = JSON.parse(response);
            document.getElementById('chantier_details_plan_canvas').innerHTML = '';
            let liste = [];
            for (let i = 0; i < obj.length; i++) {
                let IDPoint = obj[i]['IDPoint'];
                let nbpoint = obj[i]['nbpoint'];
                let x = obj[i]['x'];
                let y = obj[i]['y'];
                let IDEtat = obj[i]['IDEtat'];
                let IDFamille = obj[i]['IDFamille'];
                let colorEtat = obj[i]['colorEtat'];
                liste.push(IDPoint);
                draw_exist(IDPoint, obj.length, x, y, nbpoint, IDEtat, IDFamille, colorEtat);
            }
            localStorage.setItem('points', liste);
        }
    });
}

function check_etat() {
    localStorage.removeItem('points');
    localStorage.removeItem('familles');
    let IDChantier = document.getElementById('IDChantier').value;
    let IDPlan = document.getElementById('IDPlan').value;
    let etat = '';
    let liste = [];
    for (let i = 0; i <= document.getElementById('maxEtat').value; i++) {
        if (document.getElementById('checkIDEtat' + i).checked == false) {
            etat += " AND points.IDEtat <> '" + i + "'";
            liste.push(i);
        }
    }
    localStorage.setItem('etats', liste);
    var form_data = new FormData();                  
    form_data.append('IDChantier', IDChantier);
    form_data.append('IDPlan', IDPlan);
    form_data.append('filtre', etat);
    $.ajax({
        type: 'POST',
        url: '../Plans/points.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            let obj = JSON.parse(response);
            document.getElementById('chantier_details_plan_canvas').innerHTML = '';
            let liste = [];
            for (let i = 0; i < obj.length; i++) {
                let IDPoint = obj[i]['IDPoint'];
                let nbpoint = obj[i]['nbpoint'];
                let x = obj[i]['x'];
                let y = obj[i]['y'];
                let IDEtat = obj[i]['IDEtat'];
                let IDFamille = obj[i]['IDFamille'];
                let colorEtat = obj[i]['colorEtat'];
                liste.push(IDPoint);
                draw_exist(IDPoint, obj.length, x, y, nbpoint, IDEtat, IDFamille, colorEtat);
            }
            localStorage.setItem('points', liste);
        }
    });
}

function check_famille() {
    localStorage.removeItem('points');
    localStorage.removeItem('etats');
    let IDChantier = document.getElementById('IDChantier').value;
    let IDPlan = document.getElementById('IDPlan').value;
    let famille = '';
    liste = [];
    for (let i = 1; i <= document.getElementById('maxFamille').value; i++) {
        if (document.getElementById('checkIDFamille' + i).checked == false) {
            famille += " AND points.IDFamille <> '" + i + "'";
            liste.push(i);
        }
    }
    localStorage.setItem('familles', liste);
    var form_data = new FormData();                  
    form_data.append('IDChantier', IDChantier);
    form_data.append('IDPlan', IDPlan);
    form_data.append('filtre', famille);
    $.ajax({
        type: 'POST',
        url: '../Plans/points.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            let obj = JSON.parse(response);
            document.getElementById('chantier_details_plan_canvas').innerHTML = '';
            let liste = [];
            for (let i = 0; i < obj.length; i++) {
                let IDPoint = obj[i]['IDPoint'];
                let nbpoint = obj[i]['nbpoint'];
                let x = obj[i]['x'];
                let y = obj[i]['y'];
                let IDEtat = obj[i]['IDEtat'];
                let IDFamille = obj[i]['IDFamille'];
                let colorEtat = obj[i]['colorEtat'];
                liste.push(IDPoint);
                draw_exist(IDPoint, obj.length, x, y, nbpoint, IDEtat, IDFamille, colorEtat);
            }
            localStorage.setItem('points', liste);
        }
    });
}

function save_point(IDPoint) {
    let IDChantier = document.getElementById('IDChantier').value;
    let IDPlan = document.getElementById('IDPlan').value;
    let nompoint = document.getElementById('nompoint').value;
    let IDEtat = document.querySelector('input[name=etat]:checked').value;
    let IDFamille = document.querySelector('input[name=famille]:checked').value;
    let labelFamille = document.getElementById('labelFamille').value;
    let commentaires = document.getElementById('commentaires').value;
    var form_data = new FormData();                  
    form_data.append('IDPoint', IDPoint);
    form_data.append('nompoint', nompoint);
    form_data.append('IDEtat', IDEtat);
    form_data.append('IDFamille', IDFamille);
    form_data.append('labelFamille', labelFamille);
    form_data.append('commentaires', commentaires);
    $.ajax({
        type: 'POST',
        url: '../Plans/save_point.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('chantier_details_point').style.display = 'none';
            draw_points(IDChantier, IDPlan);
        }
    });
}

function delete_point(IDPoint) {
    if (confirm('Etes-vous certain de vouloir supprimer ce point ?') == true) {
        let IDChantier = document.getElementById('IDChantier').value;
        let IDPlan = document.getElementById('IDPlan').value;
        var form_data = new FormData();                  
        form_data.append('IDPoint', IDPoint);
        $.ajax({
            type: 'POST',
            url: '../Plans/delete_point.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                fermer_point();
                draw_points(IDChantier, IDPlan);
            }
        });
    }
}

function parcourir_plan(IDChantier) {
    document.getElementById('chargement').style.display = 'flex';
    document.getElementById('fichier_plan' + IDChantier).click();
    document.getElementById('fichier_plan' + IDChantier).onchange = function() {
        fichier = document.getElementById('fichier_plan' + IDChantier).files[0];
        envoi_plan(fichier, IDChantier);
    };
    document.getElementById('chargement').style.display = 'none';
}

function envoi_plan(fichier, IDChantier) {
    document.getElementById('chargement').style.display = 'flex';
    if(fichier != undefined) {
        var form_data = new FormData();
        form_data.append('file', fichier);
        form_data.append('IDChantier', IDChantier);
        $.ajax({
            type: 'POST',
            url: '../plans/envoi_plan.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                //alert(response);
                onglets('plans');
            }
        });
    }
    document.getElementById('chargement').style.display = 'none';
}

function parcourir_photo_point(IDPoint) {
    document.getElementById('chargement').style.display = 'flex';
    document.getElementById('fichier_photo_point' + IDPoint).click();
    document.getElementById('fichier_photo_point' + IDPoint).onchange = function() {
        fichier = document.getElementById('fichier_photo_point' + IDPoint).files[0];
        envoi_photo_point(fichier, IDPoint);
    };
}

function envoi_photo_point(fichier, IDPoint) {
    if(fichier != undefined) {
        var form_data = new FormData();
        form_data.append('file', fichier);
        form_data.append('IDPoint', IDPoint);
        $.ajax({
            type: 'POST',
            url: '../Points/envoi_photo_point.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                //alert(response);
                menu_point(IDPoint);
            }
        });
    }
    document.getElementById('chargement').style.display = 'none';
}

function supprimer_photo_point(id, IDPoint){
    if (confirm("Supprimer la photo ?")) {
        document.getElementById('chargement').style.display = 'flex';
        var form_data = new FormData();
        form_data.append('id', id);
        $.ajax({
            type: 'POST',
            url: '../Points/supprimer_photo_point.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                menu_point(IDPoint);
            }
        });
        document.getElementById('chargement').style.display = 'none';
        document.getElementById('afficher_photo').innerHTML = '';
        document.getElementById('afficher_photo').style.display = 'none';
    }
}

function afficher_photo_point(id, IDPoint){
    document.getElementById('chargement').style.display = 'flex';
    var form_data = new FormData();
    form_data.append('id', id);
    form_data.append('IDPoint', IDPoint);
    $.ajax({
        type: 'POST',
        url: '../Points/afficher_photo_point.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('afficher_photo').style.display = 'flex';
            document.getElementById('afficher_photo').innerHTML = response;
            document.getElementById('chargement').style.display = 'none';
        }
    });
}

function check_tout(menu){
    let liste = [];
    let lepoint = '';
    for (i = 0 ; i < document.getElementsByClassName('check' + menu).length ; i++){
        document.getElementById(document.getElementsByClassName('check' + menu)[i].id).checked = true;
        if (menu == 'points'){
            lepoint = document.getElementsByClassName('check' + menu)[i].id.replace('checkIDPoint', '');
        } else if (menu == 'etats'){
            lepoint = document.getElementsByClassName('check' + menu)[i].id.replace('checkIDEtat', '');
        } else if (menu == 'familles'){
            lepoint = document.getElementsByClassName('check' + menu)[i].id.replace('checkIDFamille', '');
        }
        liste.push(lepoint);
    }
    localStorage.setItem(menu, liste);
}

function uncheck_tout(menu){
    for (i = 0 ; i < document.getElementsByClassName('check' + menu).length ; i++){
        document.getElementById(document.getElementsByClassName('check' + menu)[i].id).checked = false;
        localStorage.removeItem(menu);
    }
}

/*Rapport*/
function print_rapport(IDChantier, IDPlan) {
    var form_data = new FormData();
    form_data.append('IDChantier', IDChantier);
    form_data.append('IDPlan', IDPlan);
    if (localStorage.length > 0){
        for (let i = 0; i < localStorage.length; i++){
            if (localStorage.key(i) == 'points'){
                liste_points = localStorage.getItem(localStorage.key(i));
            }
        }
    }
    form_data.append('IDPoint', liste_points);
    $.ajax({
        type: 'POST',
        url: '../Chantiers/pdf.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            var newTab = window.open("", "_blank");
            newTab.document.write(response);
        }
    });
}








//TEMP
function Liste_produits() {
    document.getElementById('chargement').style.display = 'flex';
    $.ajax({
        type: 'POST',
        url: 'Produits/base_produit.php',
        contentType: false,
        processData: false,
        success:function(response) {
            document.getElementById('chantiers').innerHTML = response;
            document.getElementById('chargement').style.display = 'none';
        }
    });
}

function afficher_cat(cat) {
    for (i = 0 ; i <document.getElementsByClassName('fleche').length ; i++) {
        if (document.getElementsByClassName('fleche')[i].id == cat) {
            document.getElementsByClassName('fleche')[i].addEventListener("dblclick", masquer_cat.bind(null, cat), false);
        }
    }
    for (i = 0 ; i <document.getElementsByClassName(cat).length ; i++) {
        document.getElementsByClassName(cat)[i].style.display = "flex";
    }
}

function masquer_cat(cat) {
    for (i = 0 ; i <document.getElementsByClassName('fleche').length ; i++) {
        if (document.getElementsByClassName('fleche')[i].id == cat) {
            document.getElementsByClassName('fleche')[i].addEventListener("dblclick", afficher_cat.bind(null, cat), false);
        }
    }
    for (i = 0 ; i <document.getElementsByClassName(cat).length ; i++) {
        document.getElementsByClassName(cat)[i].style.display = "none";
    }
}

/*function ajou_cat(niveau) {
    document.getElementById('produi').style.display = 'flex';
    var form_data = new FormData();                  
    form_data.append('niveau', niveau);
    $.ajax({
        type: 'POST',
        url: 'Produits/_add_catégories.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('produi').innerHTML = response;
        }
    });
}*/

/*function ajou_prod(niveau) {
    document.getElementById('produi').style.display = 'flex';
    var form_data = new FormData();                  
    form_data.append('niveau', niveau);
    $.ajax({
        type: 'POST',
        url: 'Produits/_add_produit.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            document.getElementById('produi').innerHTML = response;
        }
    });
}*/

function allowDrop(ev) {
    ev.preventDefault();
}

function Copier(ev) {
    ev.dataTransfer.setData("Text",ev.target.id);
    for (i = 0 ; i <document.getElementsByClassName('fleche').length ; i++) {
        if (document.getElementsByClassName('fleche')[i].id != ev.target.id) {
            document.getElementsByClassName('fleche')[i].style.display = "none";
        }
    }
    for (i = 0 ; i <document.getElementsByClassName('cible').length ; i++) {
        if (document.getElementsByClassName('cible')[i].id != ev.target.id) {
            document.getElementsByClassName('cible')[i].style.display = "block";
        }
    }
}

function Coller(ev) {
    ev.preventDefault();
    var son = ev.dataTransfer.getData("Text");
    var dad = ev.target.id;
    var form_data = new FormData();                  
    form_data.append('son', son);
    form_data.append('dad', dad);
    $.ajax({
        type: 'POST',
        url: 'Produits/_deplacer.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            for (i = 0 ; i <document.getElementsByClassName('fleche').length ; i++) {
                document.getElementsByClassName('fleche')[i].style.display = "block";
            }
            Liste_produits(0);
        }
    });
}

function save_description_produit(IDProduit, description) {
    var form_data = new FormData();
    form_data.append('IDProduit', IDProduit);
    form_data.append('description', description);
    $.ajax({
        type: 'POST',
        url: 'Produits/_save_description_produit.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {

        }
    });
}

function save_unite_produit(IDProduit, unite) {
    var form_data = new FormData();
    form_data.append('IDProduit', IDProduit);
    form_data.append('unite', unite);
    $.ajax({
        type: 'POST',
        url: 'Produits/_save_unite_produit.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {

        }
    });
}

function save_tarif_base_produit(IDProduit, tarif) {
    var form_data = new FormData();
    form_data.append('IDProduit', IDProduit);
    form_data.append('tarif', tarif);
    $.ajax({
        type: 'POST',
        url: 'Produits/_save_tarif_base_produit.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {

        }
    });
}

function save_lien(IDProduit, lien, refart) {
    var form_data = new FormData();
    form_data.append('IDProduit', IDProduit);
    form_data.append('lien', lien);
    form_data.append('refart', 'refart' + refart);
    $.ajax({
        type: 'POST',
        url: 'Produits/_save_lien.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {

        }
    });
}

function Supprimer_base(IDDetails){
    if (confirm("Supprimer ?")) {
        delet_base(IDDetails);
    }
}

function delet_base(IDDetails){
    document.getElementById('chargement').style.display = 'flex';
    var form_data = new FormData();
    form_data.append('IDDetails', IDDetails);
    $.ajax({
        type: 'POST',
        url: 'Produits/_delete_base.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            Liste_produits(1);
        }
    });
    document.getElementById('chargement').style.display = 'none';
}

function new_profil(table){
    newuser = document.getElementById('newuser').value;
    newpass = document.getElementById('newpass').value;
    newprofil = document.getElementById('newprofil').value;
    if (newuser != '' && newpass != '') {
        var form_data = new FormData();
        form_data.append('table', table);
        form_data.append('newuser', newuser);
        form_data.append('newpass', newpass);
        form_data.append('newprofil', newprofil);
        $.ajax({
            type: 'POST',
            url: 'add_administration.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                alert(response);
            }
        });
    } else {
        alert("Veuillez remplir le nom et le mot de passe de l'utilisateur");
    }
}

function save_profil(table, nom, typeid, id, value){
    var form_data = new FormData();
    form_data.append('table', table);
    form_data.append('nom', nom);
    form_data.append('typeid', typeid);
    form_data.append('id', id);
    form_data.append('value', value);
    $.ajax({
        type: 'POST',
        url: 'MAJ_administration.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {

        }
    });
}