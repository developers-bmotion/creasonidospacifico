
<template>
    <div>
        <vue-good-table :columns="columns" :rows="listAspirants">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'name'">
                    <span>{{ props.row.name }} {{ props.row.last_name }}</span>
                </span>
            </template>
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'artista.projects'">
                    <div
                        v-for="status in props.row.artista.projects"
                        :key="status.id"
                    >
                        <span
                            v-if="status.status == 1"
                            class="m-badge m-badge--metal m-badge--wide m-badge--rounded"
                            >Revisión</span
                        >
                        <span
                            v-if="status.status == 2"
                            class="m-badge m-badge--brand m-badge--wide m-badge--rounded"
                            style="background-color: #9816f4 !important"
                            >Pre aprobado</span
                        >

                        <span
                            v-if="status.status == 3"
                            class="m-badge m-badge--success m-badge--wide m-badge--rounded"
                            >Aprobado</span
                        >
                        <span
                            v-if="status.status == 4"
                            class="m-badge m-badge--warning m-badge--wide m-badge--rounded"
                            >Pendiente</span
                        >
                        <span
                            v-if="status.status == 5"
                            class="m-badge m-badge--danger m-badge--wide m-badge--rounded"
                            >Rechazado</span
                        >
                        <span
                            v-if="status.status == 6"
                            class="m-badge m-badge--brand m-badge--wide m-badge--rounded"
                            >Nueva revision</span
                        >
                        <span
                            v-if="status.status == 7"
                            class="m-badge m-badge--success m-badge--wide m-badge--rounded"
                            >Aceptado</span
                        >

                        <span
                            v-if="status.status == 8"
                            class="m-badge m-badge--warning m-badge--wide m-badge--rounded"
                            >No subsanado</span
                        >
                    </div>
                </span>
            </template>

            <!-- <template slot="table-row" slot-scope="props">
                <div v-for="status in props.row.artista.projects" :key="status.id">

                  <div class="text-center"><a href="/dashboard/project/"++" class="btn m-btn--pill btn-secondary"><i class="fa fa-eye"></i></a></div>

                </div>
            </template> -->
        </vue-good-table>
    </div>
</template>

<script>
import Vuetable from "vuetable-2";

export default {
    data() {
        return {
            listAspirants: [],
            columns: [
                {
                    label: "Nombre",
                    field: "name",
                },
                {
                    label: "Actuara como",
                    field: "artista.person_type.name",
                },
                {
                    label: "Tipo identificación",
                    field: "artista.document_type.document",
                },
                {
                    label: "N° identificación",
                    field: "artista.identification",
                },
                {
                    label: "Email",
                    field: "email",
                },
                {
                    label: "Departamento",
                    field: "artista.city.departaments.descripcion",
                },
                {
                    label: "Ciudad",
                    field: "artista.city.descripcion",
                },
                {
                    label: "Estado",
                    field: "artista.projects",
                },
                {
                    label: "Acciones",
                    field: "action",
                },
            ],
            //    rows:this.listAspirants,
        };
    },

    methods: {
        listsAspirants() {
            let resp = this;
            axios
                .get("/dashboard/aspirants-all")
                .then((result) => {
                    console.log("lista asp", result.data);
                    resp.listAspirants = result.data;
                    // resp.copyListPatterns = result.data.listPatterAll;
                    // this.getListPatternsForMonth(this.filterDate);
                })
                .catch((error) => {
                    this.showViewAlert("Algo ha salido mal " + error);
                });
        },
    },
    mounted() {
        this.listsAspirants();
    },

    components: {
        Vuetable,
    },
};
</script>
