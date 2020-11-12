
<div class="m-portlet mt-1">
    <div class="m-portlet__body  m-portlet__body--no-padding">
        <div class="row m-row--no-padding m-row--col-separator-xl d-flex ">
            <!--=====================================
                TARJETA USUARIOR REGISTRADOS
            ======================================-->
            <div class="col-md-12 col-lg-5 col-xl-2">
                <div class="m-widget24 pb-5">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            Aspirantes Registrados
                        </h4><br>
                        <span class="m-widget24__desc">Aspirantes con canción</span><br><br>
                        <span class="m-widget24__stats m--font-black pull-right pl-4" style="float: left">{{ $aspiranteRegistroCompleto }}</span>

                    </div>
                </div>
            </div>
            <!--=====================================
                   TARJETA USUARIOR PENDIENTES
           ======================================-->
            <div class="col-md-12 col-lg-5 col-xl-2">
                <div class="m-widget24 pb-5">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            Propuestas Pendientes
                        </h4><br>
                        <span class="m-widget24__desc">Enviadas a revisión</span><br><br>
                        <span class="m-widget24__stats m--font-warning pull-right pl-4" style="float: left">{{ $projectsStatePendiente }}</span>

                    </div>
                </div>
            </div>
            <!--=====================================
                    TARJETA USUARIOR NUEVA REVISIÓN
            ======================================-->
            <div class="col-md-12 col-lg-5 col-xl-2">
                <div class="m-widget24 pb-5">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            Nueva Revisión
                        </h4><br>
                        <span class="m-widget24__desc">Corregidas por aspirantes</span><br><br>
                        <span class="m-widget24__stats m--font-info pull-right pl-4" style="float: left">{{ $projectsStateNuevaRevision }}</span>

                    </div>
                </div>
            </div>
            <!--=====================================
                TARJETA USUARIOs ACEPTADOS
            ======================================-->
            <div class="col-md-12 col-lg-5 col-xl-2">
                <div class="m-widget24 pb-5">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            Propuestas Aceptadas
                        </h4><br>
                        <span class="m-widget24__desc">En proceso de curaduria</span><br><br>
                        <span class="m-widget24__stats m--font-brand pull-right pl-4" style="float: left">{{ $projectsStateAceptado }}</span>

                    </div>
                </div>
            </div>
            <!--=====================================
                TARJETA USUARIOs NO SUBSANADOS
            ======================================-->
            <div class="col-md-12 col-lg-5 col-xl-2">
                <div class="m-widget24 pb-5">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            No Subsanados
                        </h4><br>
                        <span class="m-widget24__desc">No subsanada o corregidas</span><br><br>
                        <span class="m-widget24__stats m--font-danger pull-right pl-4" style="float: left">{{ $projectsStateNoSubsanadas }}</span>

                    </div>
                </div>
            </div>
            <!--=====================================
                TARJETA USUARIOs  APROBADAS
            ======================================-->
            <div class="col-md-12 col-lg-5 col-xl-2">
                <div class="m-widget24 pb-5">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            Aprobadas
                        </h4><br>
                        <span class="m-widget24__desc">Aprobadas puntaje</span><br><br>
                        <span class="m-widget24__stats m--font-success pull-right pl-4" style="float: left">{{ $projectsStateAprobadas }}</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
