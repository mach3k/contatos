import React, { Component } from 'react';
import ModalTelefone from './modal';
import axios from 'axios';

class Telefones extends Component {
    constructor(props) {
        super(props);

        this.state = {
            idPessoa: props.pessoa,
            baseUrl: props.baseUrl,
            naoInformado: 'Não informado',
            registros: [],
            requiredItem: 0,

        }

        this.replaceModalItem = this.replaceModalItem.bind(this);
        this.saveModalDetails = this.saveModalDetails.bind(this);
        this.updateListItem = this.updateListItem.bind(this);
        this.telefoneFormatado = this.telefoneFormatado.bind(this);
    }

    componentDidMount() {
        console.log(`${this.state.baseUrl}/api/pessoa/${this.state.idPessoa}/telefones`);
        axios.get(`${this.state.baseUrl}/api/pessoa/${this.state.idPessoa}/telefones`)
        .then(response => {
            this.setState({ registros : response.data });
        })
        .catch(error => {
            console.log('deu merda');
        });

        console.log(this.state.registros);
    }

    replaceModalItem(index) {
        // console.log('Item do list: ');
        console.log(index);
        
        this.setState({
            requiredItem: index
        });

        console.log('replaceModalItem: requiredItem ');
        console.log(this.state.requiredItem);

        // this.props.replaceModalItem(item);
    }

    saveModalDetails(item) {

        console.log('saveModalDetails: ');
        console.log(item);

            this.setState(
                { registros: [...this.state.registros, item] }
            );

        console.log('acabou o saveModalDetails');
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
                                    data-toggle="modal" data-target="#modalTelefone"
                                    onClick={() => this.replaceModalItem(index)}><i className="far fa-edit"></i> Editar</button>
                                </div>
                                <div className="row">
                                    <button onClick={() => this.deleteItem(index)} type="button"
                                    className="btn btn-xs btn-block btn-outline-danger m-1"><i className="fas fa-exclamation-triangle"></i> Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {index != this.state.registros.length-1 ? <hr /> : ''}
                </div>
            )
        });

        // const requiredItem = this.state.requiredItem;
        const requiredItem = this.state.requiredItem;
        // console.log("requiredItem: " + requiredItem);
        // console.log("Endereco 1: " + this.state.telefones[1] != null ? this.state.telefones[1].logradouro : 'não definido');
        let modalData = requiredItem != null ? this.state.registros[requiredItem] : null;
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
                            data-toggle="modal" data-target="#modalNovoTelefone"
                            onClick={() => this.replaceModalItem(null)}><i className="fas fa-fw fa-plus" /> Adicionar</button>
                        </div>

                    </div>

                    <div id="collapsePhone" className="panel-collapse in collapse">
                        <div className="card-body">

                            <div className="row">
                                {console.log(lista ? lista.length : 'lista vazia')}
                                {lista ? lista : <p>Esta pessoa não possui telefones cadastrados</p>}
                                <ModalTelefone
                                    id="modalTelefone"
                                    pessoa_id={this.state.idPessoa}
                                    baseUrl={this.state.baseUrl}
                                    // registro={modalData ? modalData : null}
                                    registro={modalData}
                                    updateListItem={this.updateListItem}
                                    saveModalDetails={this.saveModalDetails}
                                />
                            </div>

                        </div>
                    </div>

                </div>

                <ModalTelefone
                    id="modalNovoTelefone"
                    pessoa_id={this.state.idPessoa}
                    baseUrl={this.state.baseUrl}
                    // registro={modalData ? modalData : null}
                    registro={null}
                    saveModalDetails={this.saveModalDetails}
                />

            </div>
        );
    }
}

export default Telefones;
