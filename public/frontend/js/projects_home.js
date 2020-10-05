$(function () {
    let texto = "There are no projects"

    if (lang === "es"){
        texto = "No hay proyectos";
    }
    
    $("#categoryProjects").on('click', 'li', function(e){
        let id = $(this).attr("data-id");
        let category = $(this).attr("data-category");
        let container = $("#projectsView"+id);
        let cantidad = container.attr("data-cantidad");
        let content = '<div class="row">';
    
        let url = "/projects-for-category";
        let data = {id: id};
    
        let success = function (r){
            //console.log(r);
            if (r.length < 1){
                content += "<div class='text-center' style='width:100%;'><p>"+texto+"</p></div>";
            }
            container.attr('data-cantidad', r.length);
            r.forEach((project, key) => {
                if (key==3){
                    content += '</div><div class="row">';
                }
                content += '<div class="col-lg-4">'+createCard(project)+'</div>';
            });
            content += "</div>";
            container.html(content);

            startCard();
        };
        setTimeout(function (){
            ajax(url,data,success,"get",null,true,"#containerProject", "Cargando...");
        },100);
    
    
    });
    /*
    function createCard(project, category){
        let porcetaje = (project.total*100)/project.price;
        if (porcetaje < 1){
            porcetaje = 0;
        }
        return show
        .replace(/__porcentaje__/g, porcetaje)
        .replace(/__title__/g, project.title)
        .replace(/__coste__/g, project.price)
        .replace(/__porcentajeBar__/g, porcetaje>100?100:porcetaje)
        .replace(/__tipo__/g, '<li><a href="">'+category+'</a></li>')
        .replace(/__days__/g, moment(project.end_time).fromNow(true));
    }
    
    
    const show = `
    <div class="col-lg-4">
        <!-- progress element -->
        <div class="xs-box-shadow fundpress-popular-item xs-bg-white">
            <div class="fundpress-item-header">
                <img src="assets/images/campaigns/campaigns-1.jpg" alt="">
                <div class="xs-item-header-content">
                    <div class="xs-skill-bar">
                        <div class="xs-skill-track">
                            <p><span class="number-percentage-count number-percentage" data-value="__porcentajeBar__" data-animation-duration="3500">0</span>%</p>
                        </div>
                    </div>
                </div>
            </div><!-- .xs-item-header .fundpress-item-header END -->
            <div class="fundpress-item-content xs-content-padding bg-color-white">
                <ul class="xs-simple-tag fundpress-simple-tag">
                    __tipo__
                </ul>
                <a href="#" class="d-block color-navy-blue fundpress-post-title">__title__</a>
                <ul class="xs-list-with-content fundpress-list-item-content">
                    <li>$__coste__<span>Pledged</span></li>
                    <li><span class="number-percentage-count number-percentage" data-value="__porcentaje__" data-animation-duration="3500">0</span>% <span>Funded</span></li>
                    <li>__days__<span>Days to go</span></li>
                </ul>
            </div><!-- .fundpress-item-content END -->
        </div>
    </div>
    `;
    */

   $("#categoryProjectsC").on('click', 'li', function(e){
        let id = $(this).attr("data-id");
        let category = $(this).attr("data-category");
        let container = $("#projectsViewC"+id);
        let cantidad = container.attr("data-cantidad");
        let content = '<div class="row">';

        let url = "/projects-for-category-completed";
        let data = {id: id};

        let success = function (r){
            //console.log(r);
            if (r.length < 1){
                content += "<div class='text-center' style='width:100%;'><p>"+texto+"</p></div>";
            }
            container.attr('data-cantidad', r.length);
            r.forEach((project, key) => {
                if (key==3){
                    content += '</div><div class="row">';
                }
                content += '<div class="col-lg-4">'+createCard(project)+'</div>';
            });
            content += "</div>";
            container.html(content);

            startCard();
        };
        setTimeout(function (){
            ajax(url,data,success,"get",null,true,"#containerProjectC", "Cargando...");
        },100);


    });

    $("#categoryProjectsC li a")[0].click();


    $("#categoryProjects li a")[0].click();
    
});
