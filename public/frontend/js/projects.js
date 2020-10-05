let texto = "There are no projects"

if (lang === "es"){
    texto = "No hay proyectos";
}

function start() {
    let container = $("#projectContainer");
    if (projects.data.length > 0) {
        //console.clear();
        //console.log(projects.data);
        //let content = '<div class="row">';
        let content = '';
        let num = 0;
        projects.data.forEach(project => {
            /*
            if (num++ === 2){
                num = 0;
                content += '</div><div class="row">';
            }
            */
            content += createCard(project);
        });
        //content += "</div>";
        container.html(content);
    } else {
        container.html("<div class='text-center' style='width:100%;'><p>"+texto+"</p></div>");
    }

    //checkProjects();
}

function checkProjects() {
    $("#sidebar").on('click', 'a', function (e) {
        let spans = $(this).find("span");
        //console.log(spans[1].text());
        if (spans[1].text() === "(0)") {
            alert("No hay proyectos en esta categoria");
        }
        e.preventDefault();
    });
}


start();
