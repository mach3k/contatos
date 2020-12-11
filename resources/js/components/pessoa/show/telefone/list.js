import React, { Component, useState } from 'react';
// import ModalTelefone from './modal';
// import ModalTelefone from '../teste/reacthookform';
import ModalTelefone from '../teste/rbs-modal';
import axios from 'axios';
// import { useHistory } from "react-router-dom";
// import { Redirect } from 'react-router'

import { ToastContainer, toast } from 'react-toastify';
// import 'react-toastify/dist/ReactToastify.css';

import SweetAlert from 'sweetalert2-react';

// import DatePicker from "react-datepicker";
// import "react-datepicker/dist/react-datepicker.css";


class Telefones extends Component {
    constructor(props) {
        super(props);

        this.state = {
            idPessoa: props.pessoa,
            baseUrl: props.baseUrl,
            naoInformado: 'Não informado',
            registros: [],
            requiredItem: null,
            show: false,
            startDate: new Date()
        }

        this.replaceModalItem = this.replaceModalItem.bind(this);
        this.saveModalDetails = this.saveModalDetails.bind(this);
        this.updateListItem = this.updateListItem.bind(this);
        this.telefoneFormatado = this.telefoneFormatado.bind(this);
        this.redireciona = this.redireciona.bind(this);
        this.toast = this.toast.bind(this);
        this.handleClose = this.handleClose.bind(this);
        this.handleShow = this.handleShow.bind(this);
        this.handleChange = this.handleChange.bind(this);
        
        // const [show, setShow] = useState(false);

        // const handleClose = () => setShow(false);
        // const handleShow = () => setShow(true);
    }

    handleChange(date) {
      this.setState({
        startDate: date
      });
    };

    handleClose(){
        this.setState({show: false});
    }

    handleShow(){
        this.setState({show: true});
    }

    componentDidMount() {
        // console.log(`${this.state.baseUrl}/api/pessoa/${this.state.idPessoa}/telefones`);
        axios.get(`${this.state.baseUrl}/api/pessoa/${this.state.idPessoa}/telefones`)
        .then(response => {
            this.setState({ registros : response.data });
        })
        .catch(error => {
            console.log('deu merda');
        });

        // console.log(this.state.registros);
    }

    replaceModalItem(index) {
        // console.log('Item do list: ');
        // console.log(index);
        
        this.setState({
            requiredItem: index
        });

        console.log('replaceModalItem: requiredItem ', this.state.requiredItem);
        // console.log(this.state.requiredItem);

        // this.props.replaceModalItem(item);
        this.handleShow();
    }

    saveModalDetails(item) {

        // console.log('saveModalDetails: ');
        // console.log(item);

            this.setState(
                { registros: [...this.state.registros, item] }
            );

        // console.log('acabou o saveModalDetails');
    }

    updateListItem(item){
        // console.log('UpdateListeItem: ');
        // console.log(item);

        // console.log('updateListItem: requiredItem ');
        // console.log(this.state.requiredItem ? this.state.requiredItem : 'null');

        const requiredItem = this.state.requiredItem;
        // console.log('requiredItem: ');
        // console.log(requiredItem);

        let tempRegistros = this.state.registros;
        // console.log('tempRegistros: ');
        // console.log(tempRegistros);

        tempRegistros[requiredItem] = item;
        // console.log('tempRegistros[requiredItem]: ');
        // console.log(tempRegistros[requiredItem]);

        this.setState({ registros: tempRegistros });

        // console.log('acabou o UpdateListeItem');
    }

    deleteItem(index) {
        let tempRegistros = this.state.registros;
        let item = tempRegistros[index];

        // console.log(item);

        axios.delete(`${this.state.baseUrl}/api/telefone/${item.id}`)
        .then(response => {

            // let tempRegistros = this.state.telefones;
            tempRegistros.splice(index, 1);
            this.setState({ registros: tempRegistros });
        })
        .catch(error => {
            console.log('deu merda ao deletar');
        });
    }

    telefoneFormatado(idRegistro){
        // console.log(`${this.state.baseUrl}/api/cepformatado/${idEndereco}`);

        axios.get(`${this.state.baseUrl}/api/numeroformatado/${idRegistro}`)
        .then(response => {

            // console.log('cep formatado: ' + response.data);
            // return response.data;
            var d = document.getElementById("cep" + idRegistro);
            d.innerHTML = " - " + response.data;
        })
        .catch(error => {
            console.log('deu merda no cep');
        });
    }

    redireciona(){

        console.log('entrou em sapoha');
        window.location = "https://www.google.com.br/";
        // let path = `https://www.google.com.br/`; 
        // let history = useHistory();
        // history.push(path);
    }

    toast(){
        console.log('manda ver');
        toast.success("Testando...");
    }

    render() {
        const lista = this.state.registros.map((item, index) => {
            return (
                <div className="col-sm-12" key={index}>
                    <div className="row">
                        <div className="col-sm-10">
                            <div className="row">
                                <div className="col-sm-6">
                                    <dl>
                                        <dt>{item.tipo.nome}</dt>
                                        <dd>
                                            <a href={'tel:' + item.ddd ? item.ddd : '' + item.numero}>{item.ddd ? '(' + item.ddd + ')' : ''} {item.numero}</a>
                                            {item.ramal ? '(' + item.ramal + ')' : ''}
                                        </dd>
                                    </dl>
                                </div>
                                <div className="col-sm-6">
                                    <dl>
                                        {item.operadora ? <dt>Operadora</dt> : ''}
                                        {item.operadora ? <dd>{item.operadora.codigo} - {item.operadora.nome}</dd> : ''}
                                    </dl>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-sm-12">
                                    <dl>
                                        {item.observacao ? <dt>Observação</dt> : null}
                                        {item.observacao ? <dd>{item.observacao}</dd> : null}
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div className="col-sm-2">
                            <div className="float-right">
                                <div className="row">
                                    <button type="button" className="btn btn-xs btn-block btn-outline-warning m-1"
                                    onClick={() => this.replaceModalItem(index)}><i className="far fa-edit"></i> Editar</button>
                                </div>
                                <div className="row">
                                    <button onClick={() => this.deleteItem(index)} type="button"
                                    className="btn btn-xs btn-block btn-outline-danger m-1"><i className="fas fa-exclamation-triangle"></i> Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <button onClick={() => this.redireciona()} type="button"
                        className="btn btn-xs btn-block btn-outline-danger m-1"><i className="fas fa-exclamation-triangle"></i> Google</button>
                    </div>
                    <div className="row">
                        <button onClick={() => this.toast()} type="button"
                        className="btn btn-xs btn-block btn-outline-primary m-1"> Toast the bagaça</button>
                    </div>
                    <div className="form-group">
                        <label>Date Picker:</label>

                        <div className="input-group">
                            <div className="input-group-prepend">
                                <span className="input-group-text">
                                    <i className="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            {/* <DatePicker
                                selected={this.state.startDate}
                                onChange={this.handleChange}
                                className="form-control float-right"
                            /> */}
                        </div>
                    </div>
                                        
                    <div className="row">
                        <button onClick={() => this.setState({ askDelete: true })}>Alert</button>
                        <SweetAlert
                            show={this.state.askDelete}
                            type= "warning"
                            title="Você tem certeza?"
                            text="Depois de excluir, você não pode mais recuperar este registro!"
                            confirmButtonText= 'Excluir'
                            confirmButtonColor= 'red'
                            showCancelButton
                            cancelButtonText= 'Cancelar'
                            reverseButtons
                            onConfirm={() => this.setState({ askDelete: false })}
                        />
                    </div>
                    {index != this.state.registros.length-1 ? <hr /> : ''}
                    <ToastContainer />
                </div>
            )
        });

        // const requiredItem = this.state.requiredItem;
        const requiredItem = this.state.requiredItem;
        // console.log("requiredItem: " + requiredItem);
        // console.log("Endereco 1: " + this.state.telefones[1] != null ? this.state.telefones[1].logradouro : 'não definido');
        let modalData = requiredItem !== null && requiredItem !== undefined ? this.state.registros[requiredItem] : null;
        // console.log('this.state.requiredItem: ' + `${this.state.requiredItem}`);
        // console.log('requiredItem: ' + `${requiredItem}`);
        // console.log('modalData: ' + `${modalData}`);
        // let tipo = modalData ? modalData.tipo.nome : null;
        // let tipo = modalData ? modalData.cidade.estado.pais_id : null;
        // console.log('modalData: ' + tipo);
        return (
            <div className="col-sm-6">
                <div className="card card-outline card-primary">
                    <div className="card-header">

                        <h4 className="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePhone"
                            className="collapsed" aria-expanded="false">
                                <i className="fas fa-fw fa-phone-alt"></i> Telefones
                            </a>
                        </h4>

                        <div className="float-right col-sm-3">
                            <button type="button" className="btn btn-xs btn-block btn-outline-primary"
                            data-toggle="modal" data-target="#modalTelefone"
                            // onClick={() => this.replaceModalItem(null)}><i className="fas fa-fw fa-plus" /> Adicionar</button>
                            onClick={() => this.replaceModalItem(null)}><i className="fas fa-fw fa-plus" /> Adicionar</button>
                        </div>

                    </div>

                    <div id="collapsePhone" className="panel-collapse in collapse">
                        <div className="card-body">

                            <div className="row">
                                {/* {console.log(lista ? lista.length : 'lista vazia')} */}
                                {lista.length ? lista : <p>Esta pessoa não possui telefones cadastrados</p>}
                                {/* <ModalTelefone
                                    id="modalTelefone"
                                    pessoa_id={this.state.idPessoa}
                                    baseUrl={this.state.baseUrl}
                                    // registro={modalData ? modalData : null}
                                    registro={modalData}
                                    updateListItem={this.updateListItem}
                                    saveModalDetails={this.saveModalDetails}
                                /> */}
                            </div>

                        </div>
                    </div>

                </div>

                <ModalTelefone
                    show={this.state.show}
                    handleClose={this.handleClose}
                    baseUrl={this.state.baseUrl}
                    pessoa_id={this.state.idPessoa}
                    registro={modalData}
                    saveModalDetails={this.saveModalDetails}
                    updateListItem={this.updateListItem}
                />

                {/* <ModalTelefone
                    id="modalTelefone"
                    pessoa_id={this.state.idPessoa}
                    baseUrl={this.state.baseUrl}
                    // registro={modalData ? modalData : null}
                    registro={modalData}
                    updateListItem={this.updateListItem}
                    saveModalDetails={this.saveModalDetails}
                /> */}

            </div>
        );
    }
}

export default Telefones;
