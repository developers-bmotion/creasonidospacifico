<template>
    <fragment>
        <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
            <span class="m-nav__link-badge m-badge  m-badge m-badge--danger m-badge--danger" v-if="notifications.length>0" >{{notifications.length}}</span>
            <span class="m-nav__link-icon"><i class="flaticon-alarm"></i></span>
        </a>
        <div class="m-dropdown__wrapper">
            <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
            <div class="m-dropdown__inner">
                <div class="m-dropdown__header m--align-center"
                     style="background: url(/backend/assets/app/media/img/misc/notification_bg.jpg); background-size: cover;"

                >
                    <span class="m-dropdown__header-title">{{notifications.length < 1 ? 'Sin notificaciones': 'New'}}</span>
                        <span class="m-dropdown__header-subtitle" v-if="notifications.length > 0">User Notifications</span>
                </div>
                <div class="m-dropdown__body" v-if="notifications.length > 0">
                    <div class="m-dropdown__content">
                        <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
                            <li class="nav-item m-tabs__item" v-if="notificationsProcessed[tab.id].length > 0" v-for="tab in tabs" :key="tab.id" @click="actived = tab.id">
                                <a class="nav-link m-tabs__link" v-bind:class="{active: (tab.id === actived)}" data-toggle="tab"
                                   :href="'#topbar_notifications_notifications_' + tab.id" role="tab">
                                    {{ tab[lang] }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" v-if="notificationsProcessed[tab.id].length > 0" v-for="tab in tabs" :key="tabs.id">
                            <div class="tab-pane" v-bind:class="{active: (tab.id === actived)}" :id="'#topbar_notifications_notifications_' + tab.id"
                                 role="tabpanel">
                                <div class="m-scrollable" data-scrollable="true" data-height="250"
                                     data-mobile-height="200">
                                    <div class="notificacion__item" v-for="notification in notificationsProcessed[tab.id]" :key="notification.notifiable_id">
                                        <p @click="abrir(notification)" class="notificacion__item--text">{{notification.data.title}}</p>
                                        <i class="fas fa-times eliminar" @click.prevent="eliminar(notification)"></i>
                                    </div>
                                    <!--<div class="m-list-timeline m-list-timeline&#45;&#45;skin-light">
                                        <div class="m-list-timeline__items">
                                         <div class="m-list-timeline__item">
                                                                 <span
                                                                     class="m-list-timeline__badge -m-list-timeline__badge&#45;&#45;state-success"></span>
                                             <span
                                                 class="m-list-timeline__text">12 new users {{tab}}</span>
                                             <span class="m-list-timeline__time">Just now</span>
                                         </div>
                                         <div class="m-list-timeline__item">
                                             <span class="m-list-timeline__badge"></span>
                                             <span class="m-list-timeline__text">System shutdown <span
                                                 class="m-badge m-badge&#45;&#45;success m-badge&#45;&#45;wide">pending</span></span>
                                             <span class="m-list-timeline__time">14 mins</span>
                                         </div>
                                         <div class="m-list-timeline__item">
                                             <span class="m-list-timeline__badge"></span>
                                             <span
                                                 class="m-list-timeline__text">New invoice received</span>
                                             <span class="m-list-timeline__time">20 mins</span>
                                         </div>
                                         <div class="m-list-timeline__item">
                                             <span class="m-list-timeline__badge"></span>
                                             <span class="m-list-timeline__text">DB overloaded 80% <span
                                                 class="m-badge m-badge&#45;&#45;info m-badge&#45;&#45;wide">settled</span></span>
                                             <span class="m-list-timeline__time">1 hr</span>
                                         </div>
                                         <div class="m-list-timeline__item">
                                             <span class="m-list-timeline__badge"></span>
                                             <span class="m-list-timeline__text">System error - <a
                                                 href="#" class="m-link">Check</a></span>
                                             <span class="m-list-timeline__time">2 hrs</span>
                                         </div>
                                         <div class="m-list-timeline__item m-list-timeline__item&#45;&#45;read">
                                             <span class="m-list-timeline__badge"></span>
                                             <span href="" class="m-list-timeline__text">New order received <span
                                                 class="m-badge m-badge&#45;&#45;danger m-badge&#45;&#45;wide">urgent</span></span>
                                             <span class="m-list-timeline__time">7 hrs</span>
                                         </div>
                                         <div class="m-list-timeline__item m-list-timeline__item&#45;&#45;read">
                                             <span class="m-list-timeline__badge"></span>
                                             <span
                                                 class="m-list-timeline__text">Production server down</span>
                                             <span class="m-list-timeline__time">3 hrs</span>
                                         </div>
                                         <div class="m-list-timeline__item">
                                             <span class="m-list-timeline__badge"></span>
                                             <span
                                                 class="m-list-timeline__text">Production server up</span>
                                             <span class="m-list-timeline__time">5 hrs</span>
                                         </div>
                                     </div>
                                    </div>-->
                                </div>
                            </div>
                            <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
                                <div class="m-scrollable" data-scrollable="true" data-height="250"
                                     data-mobile-height="200">
                                    <!--<div class="m-list-timeline m-list-timeline&#45;&#45;skin-light">
                                    <div class="m-list-timeline__items">
                                        <div class="m-list-timeline__item">
                                                                <span
                                                                    class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;state1-success"></span>
                                            <a href="" class="m-list-timeline__text">New order
                                                received</a>
                                            <span class="m-list-timeline__time">Just now</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                                                <span
                                                                    class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;state1-danger"></span>
                                            <a href="" class="m-list-timeline__text">New invoice
                                                received</a>
                                            <span class="m-list-timeline__time">20 mins</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                                                <span
                                                                    class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;state1-success"></span>
                                            <a href="" class="m-list-timeline__text">Production server
                                                up</a>
                                            <span class="m-list-timeline__time">5 hrs</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                                                <span
                                                                    class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;state1-info"></span>
                                            <a href="" class="m-list-timeline__text">New order
                                                received</a>
                                            <span class="m-list-timeline__time">7 hrs</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                                                <span
                                                                    class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;state1-info"></span>
                                            <a href="" class="m-list-timeline__text">System shutdown</a>
                                            <span class="m-list-timeline__time">11 mins</span>
                                        </div>
                                        <div class="m-list-timeline__item">
                                                                <span
                                                                    class="m-list-timeline__badge m-list-timeline__badge&#45;&#45;state1-info"></span>
                                            <a href="" class="m-list-timeline__text">Production server
                                                down</a>
                                            <span class="m-list-timeline__time">3 hrs</span>
                                        </div>
                                    </div>
                                </div>-->
                                </div>
                            </div>
                            <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fragment>
</template>

<script>
    export default {
        mounted() {
            this.notifications = JSON.parse(this.notificationsjson);
            this.lang = window.lang;
            this.parseInfo();
        },
        props: ['notificationsjson'],
        data() {
            return {
                lang: 'es',

                notifications: [],

                tabs: [
                    { id: 2, "es":'Pre Aprobado', "en": 'Pre Approved'},
                    { id: 3, "es":'Aprobado', "en": 'Approved'},
                    { id: 4, "es":'Publicado', "en": 'Published'}
                ],

                actived: 20,

                notificationsProcessed: {
                    1: [],
                    2: [],
                    3: [],
                    4: [],
                    5: []
                }
            }
        },
        methods: {
            setDataNotification(number, data) {
                this.notificationsProcessed[number].push(data);
                if (number < this.actived) {
                    this.actived = number;
                }
            },
            eliminar(notification) {
                axios.patch('/notification-read/' + notification.id)
                    .then(res => {
                        this.notifications = this.notifications.filter(n => {
                            return n.id !== notification.id;
                        });
                        this.parseInfo();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            abrir(notification) {
               axios.patch('/notification-read/' + notification.id)
                    .then(res => {
                        this.notifications = this.notifications.filter(n => {
                            return n.id !== notification.id;
                        });
                        this.parseInfo();
                    })
                    .catch(err => {
                        console.log(err);
                    });
               window.location = '/dashboard/project/' + notification.data.slug;
            },
            parseInfo() {
                this.reset();

                this.notifications.map(notification => {
                    if (notification.type.indexOf('UpdatedProject') !== -1) {
                        const project = notification;
                        switch (parseInt(notification.data.status)) {
                            case 1:
                                this.setDataNotification(1, project);
                                break;
                            case 2:
                                this.setDataNotification(2, project);
                                break;
                            case 3:
                                this.setDataNotification(3, project);
                                break;
                            case 4:
                                this.setDataNotification(4, project);
                                break;
                            case 5:
                                this.setDataNotification(5, project);
                                break;
                        }
                    }
                })
            },
            reset() {
                this.notificationsProcessed = {
                    1: [],
                    2: [],
                    3: [],
                    4: [],
                    5: []
                };
                this.actived = 85;
            }
        }
    }
</script>
<style scoped>
    .notificacion__item{
        position: relative;
        box-shadow: inset 0 0 .3rem var(--purple);
        border-radius: .5rem;
        display: flex;
        cursor: pointer;
    }
    .notificacion__item--text{
        margin: 0;
        padding: .5rem 1rem;
        width: 100%;
    }
    .eliminar{
        cursor: pointer;
        position: absolute;
        top: 0;
        right: 1rem;
        bottom: 0;
        height: 1em;
        margin: auto;
        color: var(--danger);
    }
</style>
