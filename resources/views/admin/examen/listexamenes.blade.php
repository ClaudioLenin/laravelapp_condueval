<div id="listado_examens" class="col-lg-12 table-bordered table-hover table-striped table-responsive-sm table-responsive-md table-responsive table-responsive-lg table-responsive-xl" >
  <table class="table">
      <thead>
          <tr>
              <th scope="col" class="th-tabla text-center">N.</th>
              <th scope="col" class="th-tabla text-center">PTS.</th>
              <th scope="col" class="th-tabla">NÚMERO PREGUNTAS</th>
              <th scope="col" class="th-tabla">ESTADO</th>
              <th scope="col" class="th-tabla">DESCRIPCION</th>
              <th scope="col" class="th-tabla">FECHA INICIO</th>
              <th scope="col" class="th-tabla">FECHA FIN</th>
              <th scope="col" class="th-tabla">FECHA CREACIÓN</th>
              <th scope="col" class="th-tabla">OPCIONES</th>
          </tr>
      </thead>
        <tbody>
          @php
            $cont = 0;
          @endphp
          @foreach ($examenes as $examen)
            @php
              $cont ++;
            @endphp
            <tr idp='{{$examen->codexamen}}'>
              <td class="text-center">{{$cont}}</td>
              <td class="text-center">{{$examen->valoracion}}</td>
              <td class="text-center">{{$examen->numpreguntas}}</td>
              <td class="text-center" id="estado{{$examen->codexamen}}">{{$examen->estado}}</td>
              <td class="text-center" id="descripcion{{$examen->codexamen}}">{{$examen->descripcion}}</td>
              <td class="text-center" id="fechaejecucion_{{$examen->codexamen}}">{{$examen->fechaejecucion}}</td>
              <td class="text-center" id="fechafin_{{$examen->codexamen}}">{{$examen->fechafin}}</td>
              <td class="text-center">{{$examen->fechacreacion}}</td>
              <td class="text-center" idp='{{$examen->codexamen}}'>
                <a data-target="#modal_modificar_{{$examen->codexamen}}" data-toggle="modal"><button class="btn btn-info" id="abrir_modal_editar">Editar</button></a>
                <a data-target="#modal_eliminar_{{$examen->codexamen}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
              </td>
            </tr>
            @include('admin.examen.modal')
            @include('admin.examen.edit')

          @endforeach
        </tbody>
  </table>
  <div class="text-center" id="paginate_exam">
{!!$examenes->links()!!}
  </div>
</div>
