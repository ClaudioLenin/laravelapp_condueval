$(document).ready(function () {

$("#tipo_pregunta").replaceWith("\
                        <div class='col-lg-12' id='tipo_pregunta'>\n\
                            <label for='enunciado'>Enunciado</label>\n\
                            <textarea class='form-control' id='enunciado' rows='4' style='resize: none' name='enunciado' required></textarea><br/><br/>\n\
                            <div class='table-responsive'>\n\
                                <label for='correcta'>Preguntas y Respuestas</label>\n\
                                <table id='tabla_dinamica' class='col-lg-12'>\n\
                                    <tr>\n\
                                        <td  style='padding-bottom: 5px'>\n\
                                            <input  type='text' name='preguntas[]' placeholder='Pregunta' class='form-control name_list' required/>\n\
                                        </td>\n\
                                        <td  style='padding-bottom: 5px;padding-left:20px;padding-right:10px'>\n\
                                            <input type='text' name='respuestas[]' placeholder='Respuesta' class='form-control name_list' required/>\n\
                                        </td>\n\
                                        <td >\n\
                                            <button type='button' name='agregar' id='agregar' class='btn btn-success' >+</button>\n\
                                        </td>\n\
                                    </tr>\n\
                                </table>\n\
                            </div><br>\n\
                            <div class='col-lg-12'>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                          <label for='valor'>Calificación</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                          <select size='3' class='custom-select' name='valor'><option>1</option><option selected>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option></select>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                            <label for='imagen'>(Opcional) Imagen</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                             <input type='file' class='btn btn btn-warning' name='imagen'>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div><br/><br/>\n\
                        </div>");
        var i = 1;
        $('#agregar').click(function () {
i++;
        $('#tabla_dinamica').append('<tr id="row' + i + '">\n\
                                                        <td  style="padding-bottom: 5px">\n\
                                                            <input type="text" name="preguntas[]" placeholder="Pregunta" class="form-control name_list" required/>\n\
                                                        </td>\n\
                                                        <td  style="padding-bottom: 5px;padding-left:20px;padding-right:10px">\n\
                                                            <input type="text" name="respuestas[]" placeholder="Respuesta" class="form-control name_list" required/>\n\
                                                        </td>\n\
                                                        <td >\n\
                                                            <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">-</button>\n\
                                                        </td>\n\
                                                    </tr>');
});
        $(document).on('click', '.btn_remove', function () {
var button_id = $(this).attr('id');
        $('#row' + button_id + '').remove();
});
});
function cambio(x) {

                if (x == "COMPLETAR") {
        $("#tipo_pregunta").replaceWith("\
                        <div class='col-lg-12' id='tipo_pregunta' >\n\
                        <label>Ingreso Enunciado: </label>\n\
                        \n\<textarea class='form-control' id='enunciado' rows='4' style='resize: none' name='enunciado' required></textarea><br/><br/>\n\
                            <label>Ingreso Texto de: </label>\n\
                            <div id='segmentos'class='col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center'>\n\
                                <div class='col-lg-12' style='float:left;padding-top:10px;padding-bottom:20px;'>\n\
                                    <button type='button' name='agregar' id='agregar' class='btn btn-success' >Contenido</button>\n\
                                    <button type='button' name='agregar1' id='agregar1' class='btn' style='background-color:#f57c00;color:white;'>Completar</button>\n\
                                </div>\n\
                            </div>\n\
                            <div class='col-lg-12'>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                          <label for='valor'>Calificación</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                          <select size='3' class='custom-select' name='valor'><option>1</option><option selected>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option></select>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                            <label for='imagen'>(Opcional) Imagen</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                             <input type='file' class='btn btn btn-warning' name='imagen'>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div><br/><br/>\n\
                            <br/><br/>\n\
                        </div>");
                var i = 1;
                $('#agregar').click(function () {
        i++;
                $('#segmentos').append('<div id="piece1' + i + '" class="col-lg-4 col-sm-11 col-md-11 col-xs-12" style="padding-right: 0px;padding-left: 0px;padding-top:5px">\n\
                                                        <div class="col-lg-10 col-sm-11 col-md-11 col-xs-11 " style="padding-right: 0px;padding-left: 0px;">\n\
                                                            <input type="text" name="cadena[texto'+i+']" placeholder="Cadena de Texto" class="form-control name_list" required/>\n\
\n\                                                         <input type="hidden" value='+i+' name="ct"/>\n\
                                                        </div>\n\
                                                        <div class="col-lg-2 col-sm-1 col-md-1 col-xs-1" style="padding-right: 0px;padding-left: 0px;margin-right:0px;">\n\
                                                            <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove" >x</button>\n\
                                                        </div>\n\
                                                    </div>');
        });
                $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr('id');
                $('#piece1' + button_id + '').remove();
        });
                var j = 1;
                $('#agregar1').click(function () {
        j++;
                $('#segmentos').append('<div id="piece2' + j + '" class="col-lg-4 col-sm-11 col-md-11 col-xs-12" style="padding-right: 0px;padding-left: 0px;padding-top:5px">\n\
                                                        <div class="col-lg-10 col-sm-11 col-md-11 col-xs-11" style="padding-right: 0px;padding-left: 0px;">\n\
                                                            <input type="text" name="cadena[completar'+j+']" placeholder="Completar" class="form-control name_list" style="background-color:#ffe0b2;" required/>\n\
                                                            <input type="hidden" value='+j+' name="cc"/>\n\
                                                        </div>\n\
                                                        <div class="col-lg-2 col-sm-1 col-md-1 col-xs-1" style="padding-right: 0px;padding-left: 0px;margin-right:0px;">\n\
                                                            <button type="button" name="remove" id="' + j + '" class="btn btn-danger btn_remove1" >x</button>\n\
                                                        </div>\n\
                                                    </div>');
        });
                $(document).on('click', '.btn_remove1', function () {
        var button_id = $(this).attr('id');
                $('#piece2' + button_id + '').remove();
        });
        } else if (x == "RESPUESTA SIMPLE") {
        $("#tipo_pregunta").replaceWith("\
                        <div class='col-sm-12 my-1 zigzag' id='tipo_pregunta'>\n\
                            <label for='pregunta'>Ingrese Pregunta</label>\n\
                            <textarea class='form-control' id='pregunta' rows='4' style='resize: none' name='pregunta' required></textarea>\n\
                            <label for='respuesta'>Ingrese Respuesta</label>\n\
                            <textarea class='form-control' id='respuesta' rows='4' style='resize: none' name='respuesta' required></textarea>\n\
                            <br>\n\
                            <div class='col-lg-12'>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                          <label for='valor'>Calificación</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                          <select size='3' class='custom-select' name='valor'><option>1</option><option selected>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option></select>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                            <label for='imagen'>(Opcional) Imagen</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                             <input type='file' class='btn btn btn-warning' name='imagen'>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div><br/><br/>\n\
                        </div>");
        } else if (x == "UNIR") {
        $("#tipo_pregunta").replaceWith("\
                        <div class='col-lg-12' id='tipo_pregunta'>\n\
                            <label for='enunciado'>Enunciado</label>\n\
                            <textarea class='form-control' id='enunciado' rows='4' style='resize: none' name='enunciado' required></textarea><br/><br/>\n\
                            <div class='table-responsive'>\n\
                                <label for='correcta'>Preguntas y Respuestas</label>\n\
                                <table id='tabla_dinamica' class='col-lg-12'>\n\
                                    <tr>\n\
                                        <td  style='padding-bottom: 5px'>\n\
                                            <input type='text' name='preguntas[]' placeholder='Pregunta' class='form-control name_list' required/>\n\
                                        </td>\n\
                                        <td  style='padding-bottom: 5px;padding-left:20px;padding-right:10px'>\n\
                                            <input type='text' name='respuestas[]' placeholder='Respuesta' class='form-control name_list' required/>\n\
                                        </td>\n\
                                        <td >\n\
                                            <button type='button' name='agregar' id='agregar' class='btn btn-success' >+</button>\n\
                                        </td>\n\
                                    </tr>\n\
                                </table>\n\
                            </div>\n\
                            <div class='col-lg-12'>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                          <label for='valor'>Calificación</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                          <select size='3' class='custom-select' name='valor'><option>1</option><option selected>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option></select>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                            <label for='imagen'>(Opcional) Imagen</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                             <input type='file' class='btn btn btn-warning' name='imagen'>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div><br/><br/>\n\
                        </div>");
                var i = 1;
                $('#agregar').click(function () {
        i++;
                $('#tabla_dinamica').append('<tr id="row' + i + '">\n\
                                                        <td  style="padding-bottom: 5px">\n\
                                                            <input type="text" name="preguntas[]" placeholder="Pregunta" class="form-control name_list" required/>\n\
                                                        </td>\n\
                                                        <td  style="padding-bottom: 5px;padding-left:20px;padding-right:10px">\n\
                                                            <input type="text" name="respuestas[]" placeholder="Respuesta" class="form-control name_list" required/>\n\
                                                        </td>\n\
                                                        <td >\n\
                                                            <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">-</button>\n\
                                                        </td>\n\
                                                    </tr>');
        });
                $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr('id');
                $('#row' + button_id + '').remove();
        });
        } else if (x == "SELECCION SIMPLE") {
        $("#tipo_pregunta").replaceWith("\
                        <div class='col-lg-12 zigzag' id='tipo_pregunta'>\n\
                            <label for='pregunta'>Ingrese Pregunta</label>\n\
                            <textarea class='form-control' id='pregunta' rows='4' style='resize: none' name='pregunta' required></textarea><br/><br/>\n\
                            <div class='table-responsive'>\n\
                                <label for='correcta'>Ingrese Opciones</label>\n\
                                <table id='tabla_dinamica' class='col-lg-12'>\n\
                                    <tr>\n\
                                        <td class='col-lg-12' style='padding-bottom: 5px'>\n\
                                            <input type='text' name='correcta' placeholder='Respuesta Correcta' class='form-control name_list' required/>\n\
                                        </td>\n\
                                        <td class='col-lg-1'>\n\
                                            <button type='button' name='agregar' id='agregar' class='btn btn-success' >+</button>\n\
                                        </td>\n\
                                    </tr>\n\
                                </table>\n\
                            </div>\n\
                            <div class='col-lg-12'>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                          <label for='valor'>Calificación</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                          <select size='3' class='custom-select' name='valor'><option>1</option><option selected>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option></select>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                            <label for='imagen'>(Opcional) Imagen</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                             <input type='file' class='btn btn btn-warning' name='imagen'>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div><br/><br/>\n\
                        </div>");
                var i = 1;
                $('#agregar').click(function () {
        i++;
                $('#tabla_dinamica').append('<tr id="row' + i + '">\n\
                                                        <td class="col-lg-12" style="padding-bottom: 5px">\n\
                                                            <input type="text" name="otras[]" placeholder="Otra Opción" class="form-control name_list" required/>\n\
                                                        </td>\n\
                                                        <td class="col-lg-1">\n\
                                                            <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">-</button>\n\
                                                        </td>\n\
                                                    </tr>');
        });
                $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr('id');
                $('#row' + button_id + '').remove();
        });
        } else if (x == "SELECCION MULTIPLE") {
        $("#tipo_pregunta").replaceWith("\
                        <div class='col-lg-12 zigzag' id='tipo_pregunta'>\n\
                            <label for='pregunta'>Ingrese Pregunta</label>\n\
                            <textarea class='form-control' id='pregunta' rows='4' style='resize: none' name='pregunta' required></textarea><br/><br/>\n\
                            <div class='table-responsive'>\n\
                                <label for='correcta'>Ingrese Opciones Correctas</label>\n\
                                <table id='tabla_dinamica' class='col-lg-12'>\n\
                                    <tr>\n\
                                        <td class='col-lg-12' style='padding-bottom: 5px'>\n\
                                            <input type='text' name='correctas[]' placeholder='Respuesta Correcta' class='form-control name_list' required/>\n\
                                        </td>\n\
                                        <td class='col-lg-1'>\n\
                                            <button type='button' name='agregar' id='agregar' class='btn btn-success' >+</button>\n\
                                        </td>\n\
                                    </tr>\n\
                                </table>\n\
                            </div><br>\n\
                            <div class='table-responsive'>\n\
                                <label for='correcta'>Ingrese Opciones Incorrectas</label>\n\
                                <table id='tabla_dinamica1' class='col-lg-12'>\n\
                                    <tr>\n\
                                        <td class='col-lg-12' style='padding-bottom: 5px'>\n\
                                            <input type='text' name='otras[]' placeholder='Otra Opción' class='form-control name_list' required/>\n\
                                        </td>\n\
                                        <td class='col-lg-1'>\n\
                                            <button type='button' name='agregar1' id='agregar1' class='btn btn-success' >+</button>\n\
                                        </td>\n\
                                    </tr>\n\
                                </table>\n\
                            </div>\n\
                            <div class='col-lg-12'>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                          <label for='valor'>Calificación</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                          <select size='3' class='custom-select' name='valor'><option>1</option><option selected>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option></select>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                            <label for='imagen'>(Opcional) Imagen</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                             <input type='file' class='btn btn btn-warning' name='imagen'>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div><br/><br/>\n\
                        </div>");
                var i = 1;
                $('#agregar').click(function () {
        i++;
                $('#tabla_dinamica').append('<tr id="row' + i + '">\n\
                                                        <td class="col-lg-12" style="padding-bottom: 5px">\n\
                                                            <input type="text" name="correctas[]" placeholder="Respuesta Correcta" class="form-control name_list" required/>\n\
                                                        </td>\n\
                                                        <td class="col-lg-1">\n\
                                                            <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">-</button>\n\
                                                        </td>\n\
                                                    </tr>');
        });
                $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr('id');
                $('#row' + button_id + '').remove();
        });
                var j = 1;
                $('#agregar1').click(function () {
        j++;
                $('#tabla_dinamica1').append('<tr id="row1' + j + '">\n\
                                                        <td class="col-lg-12" style="padding-bottom: 5px">\n\
                                                            <input type="text" name="otras[]" placeholder="Otra Opción" class="form-control name_list" required/>\n\
                                                        </td>\n\
                                                        <td class="col-lg-1">\n\
                                                            <button type="button" name="remove1" id="' + j + '" class="btn btn-danger btn_remove1">-</button>\n\
                                                        </td>\n\
                                                    </tr>');
        });
                $(document).on('click', '.btn_remove1', function () {
        var button_id = $(this).attr('id');
                $('#row1' + button_id + '').remove();
        });
        } else if (x == "VERDADERO FALSO") {
        $("#tipo_pregunta").replaceWith("\
                        <div class='col-lg-12 zigzag' id='tipo_pregunta'>\n\
                            <label for='pregunta'>Ingrese Pregunta</label>\n\
                            <textarea class='form-control' id='pregunta' rows='4' style='resize: none' name='pregunta' required></textarea><br/><br/>\n\
                            <div class='table-responsive'>\n\
                                <label for='correcta'>Seleccione Opción</label>\n\
                                <div class='form-check'>\n\
                                    <input type='radio' name='seleccion' id='verdadero' value='verdadero' checked>\n\
                                    <label class='form-check-label' for='verdadero'>Verdadero</label>\n\
                                    <br>\n\
                                    <input type='radio' name='seleccion' id='falso' value='falso'>\n\
                                    <label class='form-check-label' for='falso'>Falso</label>\n\
                                </div>\n\
                            </div>\n\
                            <div class='col-lg-12'>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                          <label for='valor'>Calificación</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                          <select size='3' class='custom-select' name='valor'><option>1</option><option selected>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option></select>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                                <div class='col-lg-6'>\n\
                                    <div class='col-xs-12' style='text-align:center;justify-content:center;'>\n\
                                        <div class='col-xs-12'>\n\
                                            <label for='imagen'>(Opcional) Imagen</label><br/>\n\
                                        </div>\n\
                                        <div class='col-xs-12' >\n\
                                             <input type='file' class='btn btn btn-warning' name='imagen'>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div><br/><br/>\n\
                        </div>");
        }
        }
