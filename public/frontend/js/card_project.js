moment.locale(lang);
if (lang === "es") {
    moment.updateLocale(lang, { invalidDate: "Fecha no válida" })
}

function startCard() {
    let number_percentage = $(".number-percentage:not(.setLoad)");
    number_percentage.each(function () {
        let value = $(this).attr("data-value");
        let duration = $(this).attr("data-animation-duration");
        if (parseInt(value) < 1) {
            return;
        }
        fnAnima($(this), $(this).attr("data-value"), true, parseInt(duration, 10));
        $(this).closest('.xs-skill-bar').find('.xs-skill-track').animate({
            width: (value>100?100:(value<12?12:value)) + '%'
        }, 4500);
        $(this).addClass("setLoad");
    });
}

function fnAnima(element, stop, commas, duration, ease) {
    return element.each(function () {
        let start = parseInt(element.text().replace(/,/g, ""), 10);
        commas = (commas === undefined) ? true : commas;
        $({
            value: start
        }).animate({
            value: stop
        }, {
                duration: duration == undefined ? 500 : duration,
                easing: ease == undefined ? "swing" : ease,
                step: function () {
                    element.text(Math.floor(this.value));
                    if (commas) {
                        element.text(element.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                    }
                },
                complete: function () {
                    if (parseInt(element.text(), 10) !== stop) {
                        element.text(stop);
                        if (commas) {
                            element.text(element.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                        }
                    }
                }
            });
    });
}


function createCard(project) {
    if (project.artists) {
        artist = project.artists[0];
    }

    let porcetaje = Math.floor((project.totalDonations*100)/project.price);
    if (porcetaje < 1) {
        porcetaje = 0;
    }

    return `
<div class="xs-col-3-isotope-grid-item comics crafts">
    <div class="fundpress-grid-item-content xs-mb-30">
        <div class="xs-item-header fundpress-item-header" >
        <a href="${project.url}" >
            <p class="imagen--fixed" style="background: url(${project.project_picture});"></p>
            <img  src="${project.project_picture}" alt="Imagen del proyecto" style="display:none;" >
        </a>    
            <div class="xs-item-header-content">
                <div class="xs-skill-bar">
                    <div class="xs-skill-track">
                        <p><span class="number-percentage-count number-percentage"
                                data-value="${porcetaje}"
                                data-animation-duration="3500">0</span>%</p>
                    </div>
                </div>
            </div>
        </div><!-- .xs-item-header .fundpress-item-header END -->
        <div class="xs-item-content fundpress-item-content">
            <ul class="xs-simple-tag fundpress-simple-tag">
                <li><a href="">${project.category.category}</a></li>
            </ul>
            <a href="${project.url}"
            class="xs-post-title color-navy-blue fundpress-post-title">${project.nameLimit}</a>
            <ul class="xs-list-with-content fundpress-list-item-content">
                <li>$${project.price}<span>Prometido</span></li>
                <li><span class="number-percentage-count number-percentage"
                        data-value="${porcetaje}" data-animation-duration="3500">0</span>%
                    <span>Recaudado</span></li>
                <li>${moment(project.end_time).lang(lang).fromNow(true)}<span>Finaliza</span></li>
            </ul>
            <span class="xs-separetor border-separetor xs-separetor-v2 fundpress-separetor"></span>
            <div class="row xs-margin-0">
                <div class="full-round fundpress-avatar">
                    <img src="${project.fotoUsuario}" alt="">
                </div>
                <div class="xs-avatar-title">
                    <a href="${project.rutaPro}"><span>By</span>${artist.nickname}</a>
                </div>
            </div>
        </div><!-- .xs-item-content .fundpress-item-content END -->
    </div>
</div>`;
    /*
    cardLayout
        .replace(/${porcetaje}/g, porcetaje)
        .replace(/${project.nameLimit}/g, project.nameLimit)
        .replace(/${project.price}/g, project.price)
        .replace(/${(porcetaje > 100 ? 100 : porcetaje)}/g, porcetaje > 100 ? 100 : porcetaje)
        .replace(/<li><a href="">${project.category.category}</a></li>/g, '<li><a href="">${project.category.category}</a></li>')
        .replace(/${moment(project.end_time).fromNow(true)}/g, moment(project.end_time).fromNow(true))
        .replace(/${project.img}/g, project.img)
        .replace(/${project.url}/g, project.url)
        .replace(/${project.fotoUsuario}/g, project.fotoUsuario)
        .replace(/${$artist.nickname}/g, $artist.nickname);
    /*Listo revisalo el problema es en el blade */
}
