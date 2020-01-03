<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal_eliminar_{{$pregunta->codpregunta}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        <h4 class="modal-title">Eliminar Pregunta</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Confirme si desea eliminar la pregunta?</p>
			</div>
			<div class="modal-footer" idp="{{$pregunta->codpregunta}}">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" id="eliminar_pregunta">Confirmar</button>
			</div>
		</div>
	</div>
</div>
