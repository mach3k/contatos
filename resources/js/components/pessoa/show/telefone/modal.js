import React, { Component } from 'react';
import Select from 'react-select';
import axios from 'axios';
import { ToastContainer } from "react-toastr";

const customStyles = {
    width: '100%'
}

let container;

class ModalTelefone extends Component {
    constructor(props) {
        super(props);

        // 'numero', 'ddd', 'ramal', 'observacao',
        // 'excluido', 'pessoa_id', 'tipo_telefone_id', 'operadora_id'

        this.state = {
            baseUrl: props.baseUrl,
            pessoa_id: props.pessoa_id,
            id: props.registro ? props.registro.id : null,
            numero: '',
            ddd: '',
            ramal: '',
            observacao: '',
            tiposTelefone: [],
            tipoTelefoneSel: null,
            operadoras: [],
            operadoraSel: null,
        }

        this.tipoTelefoneHandler = this.tipoTelefoneHandler.bind(this);
        this.operadoraHandler = this.operadoraHandler.bind(this);

        this.getTiposTelefone = this.getTiposTelefone.bind(this);
        this.getOperadoras = this.getOperadoras.bind(this);

        this.handleSave = this.handleSave.bind(this);
    }

    componentWillReceiveProps(nextProps) {
        if(nextProps.registro == null){
            this.setState({
                id: null,
                numero: '',
                ddd: '',
                ramal: '',
                observacao: '',
                tipoTelefoneSel: null,
                operadoraSel: null,
            });

            return;
        }

        this.setState({
            id: nextProps.registro.id,
            numero: nextProps.registro.numero,
            ddd: nextProps.registro.ddd,
            ramal: nextProps.registro.ramal,
            observacao: nextProps.registro.observacao,
            tipoTelefoneSel: {value: nextProps.registro.tipo.id, label: nextProps.registro.tipo.nome},
            operadoraSel: {value: nextProps.registro.operadora.id, label: nextProps.registro.operadora.nome},
        });
    }

    componentDidMount(){
        // console.log('entrou no didmount');
        this.getTiposTelefone();
        this.getOperadoras();
    }

    getTiposTelefone(){
        console.log(`${this.state.baseUrl}/api/listatipostelefone`);

        axios.get(`${this.state.baseUrl}/api/listatipostelefone`)
        .then(response => {

            const registros = response.data.map((item) => {
                return {value: item.id, label: item.nome};
            });

            this.setState({ tiposTelefone : registros });

            // console.log(registros);
            // console.log(typeof response.data);
            // console.log(this.state.tiposTelefone);
        })
        .catch(error => {
            console.log('deu merda na busca de tipos de telefone');
        });
    }

    tipoTelefoneHandler(e){
        this.setState({ tipoTelefoneSel: e });
    }

    // 'numero', 'ddd', 'ramal', 'observacao',
    // 'excluido', 'pessoa_id', 'tipo_telefone_id', 'operadora_id'

    numeroHandler(e){
        this.setState({ numero: e.target.value });
    }

    dddHandler(e){
        this.setState({ ddd: e.target.value });
    }

    ramalHandler(e){
        this.setState({ ramal: e.target.value });
    }

    operadoraHandler(e){
        this.setState({ operadoraSel: e });
    }

    getOperadoras(){
        console.log(`${this.state.baseUrl}/api/listaoperadoras`);

        axios.get(`${this.state.baseUrl}/api/listaoperadoras`)
        .then(response => {

            const regs = response.data.map((item) => {
                return {value: item.id, label: item.nome};
            });

            this.setState({ operadoras : regs });
        })
        .catch(error => {
            console.log('deu merda na busca de operadoras');
        });
    }

    observacaoHandler(e){
        this.setState({ observacao: e.target.value });
    }

    handleSave() {
        // const item = this.state;

        // 'pessoa_id', 'numero', 'ddd', 'ramal', 'observacao',
        // 'excluido', 'tipo_telefone_id', 'operadora_id'

        const item = {
            id: this.state.id,
            pessoa_id: this.state.pessoa_id,
            tipo_telefone_id: this.state.tipoTelefoneSel ? this.state.tipoTelefoneSel.value : null,
            numero: this.state.numero,
            ddd: this.state.ddd,
            ramal: this.state.ramal,
            observacao: this.state.observacao,
            operadora_id: this.state.operadoraSel ? this.state.operadoraSel.value : null,
        };

        console.log('Item do modal: ');
        console.log(item);

        axios.post(`${this.state.baseUrl}/api/telefone`, item)
        .then(response => {

            console.log("Retorno do salvar...");
            console.log(response.data);

            try{
                if(item.id) {
                    this.props.updateListItem(response.data);
                } else {
                    this.props.saveModalDetails(response.data);
                }

            }catch(error){
                console.log(error);
            }
            // console.log(response.data.pessoa_id);
        })
        .catch(error => {
            console.log('deu merda ao salvar');
        });
    }

    handleClick(){
        console.log(this.state.operadoraSel);
        console.log(this.state.tipoTelefoneSel);
        console.log(this.state.operadoras);
        console.log(this.state.tiposTelefone);

        container.success(`hi! Now is ${new Date()}`, `///title\\\\\\`, {
            closeButton: true,
            timeOut: 3000,
            extendedTimeOut: 10000
          });
    }

    render() {

        return (

            <>
            
            <ToastContainer
                ref={ref => container = ref}
                className="toast-top-right"
            />
            
            <div className="modal fade" id={this.props.id} tabIndex="-1" role="dialog" aria-labelledby="modalTelefoneLabel" aria-hidden="true">
                <div className="modal-dialog modal-default" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h4 className="modal-title" id="modalTelefoneLabel">Número de telefone</h4>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-body">
                            <div className="row">
                                <div className="col-sm-3">
                                    <div className="form-group">
                                        <label htmlFor="ddd">DDD</label>
                                        <input type="number" className="form-control" name="ddd" min="1" max="9999" placeholder="(     )"
                                        value={this.state.ddd} onChange={(e) => this.dddHandler(e)} />
                                    </div>
                                </div>

                                <div className="col-sm-6">
                                    <div className="form-group">
                                        <label htmlFor="numero">Número</label>
                                        <input type="text" className="form-control" name="numero" maxLength="15" placeholder="" autoFocus required
                                        value={this.state.numero ? this.state.numero : ''} onChange={(e) => this.numeroHandler(e)} />
                                    </div>
                                </div>

                                <div className="col-sm-3">
                                    <div className="form-group">
                                        <label htmlFor="ramal">Ramal</label>
                                        <input type="text" className="form-control" name="ramal" maxLength="10" placeholder=""
                                        value={this.state.ramal ? this.state.ramal : ''} onChange={(e) => this.ramalHandler(e)} />
                                    </div>
                                </div>
                            </div>

                            <div className="row">
                                <div className="col-sm-6" data-select2-id="1">
                                    <div className="form-group">
                                        <label htmlFor="tipo_telefone_id">Tipo</label>
                                        <Select
                                            className="basic-multi-select"
                                            classNamePrefix="select"
                                            value={this.state.tipoTelefoneSel}
                                            styles={customStyles}
                                            placeholder="Selecione um tipo"
                                            isClearable={true}
                                            isSearchable={true}
                                            name="tipo_telefone_id"
                                            options={this.state.tiposTelefone}
                                            onChange={this.tipoTelefoneHandler}
                                            isMulti
                                        />
                                    </div>
                                </div>

                                <div className="col-sm-6" data-select2-id="2">
                                    <div className="form-group">
                                        <label htmlFor="operadora_id">Operadora</label>
                                        <Select
                                            className="basic-single"
                                            classNamePrefix="select"
                                            value={this.state.operadoraSel}
                                            styles={customStyles}
                                            placeholder="Selecione a operadora"
                                            isClearable={true}
                                            isSearchable={true}
                                            name="operadora_id"
                                            options={this.state.operadoras}
                                            onChange={this.operadoraHandler}
                                        />
                                    </div>
                                </div>
                            </div>

                            <div className="row">
                                <div className="col-sm-12">
                                    <div className="form-group">
                                        <label htmlFor="observacao">Observação</label>
                                        <textarea name="observacao" className="form-control" rows="3" maxLength="300" placeholder=""
                                        value={this.state.observacao ? this.state.observacao : ''} onChange={(e) => this.observacaoHandler(e)} />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="modal-footer justify-content-between">
                            <button type="button" className="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="button" className="btn btn-outline-primary" data-dismiss="modal"
                            onClick={() => { this.handleSave() }} id="salvarTelefone">Salvar</button>
                            <button type="button" className="btn btn-primary" onClick={() => { this.handleClick() }} id="verState">Ver State</button>
                        </div>
                    </div>
                </div>
            </div>
            </>
        );
    }
}

export default ModalTelefone;
