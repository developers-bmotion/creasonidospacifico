<template>
    <div class="m-widget3">
        <!--<div class="m-widget3__item">
            <div class="m-widget3__header">
                <div class="m-widget3__user-img">
                    <img class="m-widget3__img"
                         src="http://lorempixel.com/200/100/food/"
                         alt="">
                </div>
                <div class="m-widget3__info">
														<span class="m-widget3__username">
															Melania Trump
														</span><br>
                    <span class="m-widget3__time">
															2 day ago
														</span>
                </div>
                <span class="m-widget3__status m&#45;&#45;font-info">
														Pending
													</span>
            </div>
            <div class="m-widget3__body">
                <p class="m-widget3__text">
                    Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy
                    nibh euismod tinciduntut laoreet doloremagna aliquam erat volutpat.
                </p>
            </div>
        </div>
        <div class="m-widget3__item">
            <div class="m-widget3__header">
                <div class="m-widget3__user-img">
                    <img class="m-widget3__img"
                         src="http://lorempixel.com/200/100/food/"
                         alt="">
                </div>
                <div class="m-widget3__info">
														<span class="m-widget3__username">
															Lebron King James
														</span><br>
                    <span class="m-widget3__time">
															1 day ago
														</span>
                </div>
                <span class="m-widget3__status m&#45;&#45;font-brand">
														Open
													</span>
            </div>
            <div class="m-widget3__body">
                <p class="m-widget3__text">
                    Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy
                    nibh euismod tinciduntut laoreet doloremagna aliquam erat volutpat.Ut
                    wisi
                    enim ad minim veniam,quis nostrud exerci tation ullamcorper.
                </p>
            </div>
        </div>-->
        <div class="m-widget3__item" v-for="project in projects" :key="project.id">
            <div class="m-widget3__header">
                <div class="m-widget3__user-img">
                    <img class="m-widget3__img"
                         :src="project.project_picture"
                         :alt="'Imagen del proyecto ' + project.title">
                </div>
                <div class="m-widget3__info">
                    <span class="m-widget3__username">
                        {{ project.title }}
                    </span>
                    <br>
                    <!--<span class="m-widget3__time">
                        3 weeks ago
                    </span>-->
                </div>
                <span class="m-widget3__status m--font-success">
                    <a @click='showMessages(project.id)' class="btn m-btn--pill btn-secondary">
                        <i class="fa fa-envelope"></i>
                    </a>
                </span>
            </div>
            <div class="m-widget3__body">
                <p class="m-widget3__text">
                    {{ (project && project.messages) ? project.messages[project.messages.length-1].comments: '' }}
                </p>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            this.user = JSON.parse(this.userjson);
            this.getMessages();
        },
        data() {
            return {
                user: null,
                projects: []
            }
        },
        props: ['userjson'],
        methods: {
            getMessages() {
                axios.get('/project-message-artist')
                    .then((response) => {
                        console.log(response.data,"ssssssss");
                        this.projects = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                        this.project = [];
                    });
            },
            showMessages(id) {
                window.mostrarMensaje(id);
                document.getElementById("m_quick_sidebar_toggle").click();
            }
        }
    }
</script>
<style scoped>
    .m-widget3__img{
        width: 3.2rem;
        height: 3.2rem;
        overflow: hidden;
        max-height: 3.2rem;
        max-width: 3.2rem;
        box-shadow: 0 0 .2rem #0a6aa1;
    }
</style>
