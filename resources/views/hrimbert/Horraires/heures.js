function maj(date){
    debutMatin = document.getElementById('debutMatin' + date).value;
    finMatin = document.getElementById('finMatin' + date).value;
    debutSoir = document.getElementById('debutSoir' + date).value;
    finSoir = document.getElementById('finSoir' + date).value;
    var form_data = new FormData();                  
    form_data.append('date', date);
    form_data.append('debutMatin', debutMatin);
    form_data.append('finMatin', finMatin);
    form_data.append('debutSoir', debutSoir);
    form_data.append('finSoir', finSoir);
    $.ajax({
        type: 'POST',
        url: 'save_heures.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {

        }
    });
}