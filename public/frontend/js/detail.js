function processProject(){
    let porcentajeProject = 100-(((project.price-project.informacionDonations.totalDonations)/100)*100);
    if (porcentajeProject < 1) {
        porcentajeProject = 0;
    }
    $(".porcentajeProject").attr("data-percent", porcentajeProject);
    $("#txtRecaudado").html(project.informacionDonations.totalDonations);
    $("#txtNumPatrocinadores").html(project.informacionDonations.totalDonors);
}

processProject();