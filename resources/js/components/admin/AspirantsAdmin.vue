
<template>
    <div>
        <vue-good-table
        :columns="columns"
        :rows="listAspirants"
        :pagination-options="{
            enabled: true,
            mode: 'records'
        }"
        :line-numbers="true"
        >
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'name'">
                    <span>{{ props.row.name }} {{ props.row.last_name }}</span>
                </span>
                 <span v-else-if="props.column.field == 'status'">
                    <div
                        v-for="status in props.row.artista.projects"
                        :key="status.id"
                    >c
                        <span
                            v-if="status.status == 1"
                            class="m-badge m-badge--metal m-badge--wide m-badge--rounded"
                            >Revisión</span>
                        <span
                            v-if="status.status == 2"
                            class="m-badge m-badge--brand m-badge--wide m-badge--rounded"
                            style="background-color: #9816f4 !important"
                            >Calificado</span
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
                <span v-else-if="props.column.field == 'action'">
                <div v-for="project in props.row.artista.projects" :key="project.id">

                  <div class="text-center"><a :href="'/dashboard/project/'+project.slug" class="btn m-btn--pill btn-secondary"><i class="fa fa-eye"></i></a></div>

                </div>
                </span>
            </template>

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
                    label: "Nombres y Apellidos",
                    field: "name",
                },
                {
                    label: "Actuará como",
                    field: "artista.person_type.name",
                },
                {
                    label: "Tipo Identificación",
                    field: "artista.document_type.document",
                },
                {
                    label: "N° Identificación",
                    field: "artista.identification",
                },
                {
                    label: "Correo Eléctronico",
                    field: "email",
                },
                {
                    label: "Departamento Nacimiento",
                    field: "artista.city.departaments.descripcion",
                },
                {
                    label: "Ciudad Nacimiento",
                    field: "artista.city.descripcion",
                },
                {
                    label: "Estado",
                    field: "status",
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
<style lang="">
.vgt-table tr:hover{
    background-color: #6b6a6a0f !important;
}

td.vgt-left-align span {
    font-size: 0.9rem;
}
th.vgt-left-align.sortable span {
    font-size: 0.9rem;
}
</style>
