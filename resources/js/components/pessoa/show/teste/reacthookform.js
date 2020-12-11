import React from "react";
import { useForm } from "react-hook-form";
// import Select from 'react-select';
// import axios from 'axios';

const customStyles = {
    width: '100%'
}

const ModalTelefone = (baseUrl, pessoa_id, registro, id ) => {
    const { register, handleSubmit, errors } = useForm();
    // const [registro, setRegistro] = useState({registro});

    // useEffect(() => {
    //     document.title = `Você clicou ${count} vezes`;
    // });
    
    // const [show, setShow] = useState(false);

    // const handleClose = () => setShow(false);
    // const handleShow = () => setShow(true);
    
    function onSubmit(data) {
        console.log("Data submitted: ", data);
    }

    const teste = (e) => (
        console.log('qualquer coisa', e.target.value)
    );

    return (
        <div className="modal fade" id={id} tabIndex="-1" role="dialog" aria-labelledby="modalTelefoneLabel" aria-hidden="true">
                <div className="modal-dialog modal-default" role="document">
                    <div className="modal-content">

                        <div className="modal-header">
                            <h4 className="modal-title" id="modalTelefoneLabel">Número de telefone</h4>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div className="modal-body">
                            <form id="formTelefone" onSubmit={handleSubmit(onSubmit)} noValidate>
                                <label htmlFor="inputTelefone">Telefone</label>
                                <input
                                    type="number"
                                    id="inputTelefone"
                                    name="telefone"
                                    ref={register({
                                    required: "Informe seu telefone",
                                    pattern: {
                                        value: /\d+/g,
                                        message: "Informe apenas números",
                                    },
                                    })}
                                />
                                {errors.telefone && <p className="error">{errors.telefone.message}</p>}
                            </form>
                        </div>

                    <div className="modal-footer justify-content-between">
                        <button type="button" className="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" form="formTelefone" className="btn btn-outline-primary" data-dismiss="modal" id="salvarTelefone">Salvar</button>
                    </div>

                </div>
            </div>
        </div>
    );
  };
  
  export default ModalTelefone;
  