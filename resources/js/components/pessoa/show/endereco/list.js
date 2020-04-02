import React, { Component } from 'react';
import ModalEndereco from './modal';
import axios from 'axios';

class Enderecos extends Component {
    constructor(props) {
        super(props);

        this.state = {
            idPessoa: props.pessoa,
            baseUrl: props.baseUrl,
            naoInformado: 'Não informado',
            enderecos: [],
            requiredItem: 0,

        }

        this.replaceModalItem = this.replaceModalItem.bind(this);
        this.saveModalDetails = this.saveModalDetails.bind(this);
        this.updateListItem = this.updateListItem.bind(this);
        this.cepFormatado = this.cepFormatado.bind(this);
    }

    componentDidMount() {
        console.log(`${this.state.baseUrl}/api/pessoa/${this.state.idPessoa}/enderecos`);
        axios.get(`${this.state.baseUrl}/api/pessoa/${this.state.idPessoa}/enderecos`)
        .then(response => {
            this.setState({ enderecos : response.data });
        })
        .catch(error => {
            console.log('deu merda');
        });

        console.log(this.state.enderecos);
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
        // const requiredItem = this.state.requiredItem;
        // let tempbrochure = this.state.brochure;
        // tempbrochure[requiredItem] = item;
        // this.setState({ brochure: tempbrochure });

        // console.log('Item do list: ');
        // console.log(item);
        // console.log(`${this.state.baseUrl}/api/endereco`);

        // axios.post(`${this.state.baseUrl}/api/endereco`, item)
        // .then(response => {

            // console.log("Bateu no salvar...");
            // console.log(response.data);
        console.log('saveModalDetails: ');
        console.log(item);

            this.setState(
                { enderecos: [...this.state.enderecos, item] }
                // { enderecos: [item] }
            );
            // console.log(registros);
            // console.log(typeof response.data);
            // console.log(this.state.tiposEndereco);
        // })
        // .catch(error => {
        //     console.log('deu merda ao salvar');
        // });
        console.log('acabou o saveModalDetails');
    }

    updateListItem(item){
        console.log('UpdateListeItem: ');
        console.log(item);

        console.log('updateListItem: requiredItem ');
        console.log(this.state.requiredItem ? this.state.requiredItem : 'null');

        const requiredItem = this.state.requiredItem;
        console.log('requiredItem: ');
        console.log(requiredItem);

        let tempRegistros = this.state.enderecos;
        console.log('tempRegistros: ');
        console.log(tempRegistros);

        tempRegistros[requiredItem] = item;
        console.log('tempRegistros[requiredItem]: ');
        console.log(tempRegistros[requiredItem]);

        this.setState({ enderecos: tempRegistros });

        console.log('acabou o UpdateListeItem');
    }

    deleteItem(index) {
        let tempRegistros = this.state.enderecos;
        let item = tempRegistros[index];

        // console.log(item);

        axios.delete(`${this.state.baseUrl}/api/endereco/${item.id}`)
        .then(response => {

            // let tempRegistros = this.state.enderecos;
            tempRegistros.splice(index, 1);
            this.setState({ enderecos: tempRegistros });
        })
        .catch(error => {
            console.log('deu merda ao deletar');
        });
    }

    cepFormatado(idEndereco){
        // console.log(`${this.state.baseUrl}/api/cepformatado/${idEndereco}`);

        axios.get(`${this.state.baseUrl}/api/cepformatado/${idEndereco}`)
        .then(response => {

            // console.log('cep formatado: ' + response.data);
            // return response.data;
            var d = document.getElementById("cep" + idEndereco);
            d.innerHTML = " - CEP " + response.data;
        })
        .catch(error => {
            console.log('deu merda no cep');
        });
    }

    render() {
        const lista = this.state.enderecos.map((item, index) => {
            return (
                <div className="col-sm-12" key={index}>
                    <div className="row">
                        <div className="col-sm-10">
                            <dl>
                                <dt>{item.tipo.nome}</dt>
                                <dd>{item.logradouro}, {item.numero}{item.complemento ? ` - ${item.complemento}` : null}
                                {item.bairro ? ` - ${item.bairro}` : null} - {item.cidade.nome} / {item.cidade.estado.sigla}
                                {item.cep ? this.cepFormatado(item.id) : null}<span id={"cep" + item.id}></span></dd>

                                {item.observacao ? <dt>Observação</dt> : null}
                                {item.observacao ? <dd>{item.observacao}</dd> : null}

                            </dl>
                        </div>

                        <div className="col-sm-2">
                            <div className="float-right">
                                <div className="row">
                                    <button type="button" className="btn btn-xs btn-block btn-outline-warning m-1"
                                    data-toggle="modal" data-target="#modalEndereco"
                                    onClick={() => this.replaceModalItem(index)}><i className="far fa-edit"></i> Editar</button>
                                </div>
                                <div className="row">
                                    <button onClick={() => this.deleteItem(index)} type="button"
                                    className="btn btn-xs btn-block btn-outline-danger m-1"><i className="fas fa-exclamation-triangle"></i> Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {index != this.state.enderecos.length-1 ? <hr /> : ''}
                </div>
            )
        });

        // const requiredItem = this.state.requiredItem;
        const requiredItem = this.state.requiredItem;
        // console.log("requiredItem: " + requiredItem);
        // console.log("Endereco 1: " + this.state.enderecos[1] != null ? this.state.enderecos[1].logradouro : 'não definido');
        let modalData = requiredItem != null ? this.state.enderecos[requiredItem] : null;
        // console.log('modalData: ' + `${modalData}`);
        // let tipo = modalData ? modalData.tipo.nome : null;
        // let tipo = modalData ? modalData.cidade.estado.pais_id : null;
        // console.log('modalData: ' + tipo);
        return (
            <div className="col-sm-6">
                <div className="card card-outline card-primary">
                    <div className="card-header">

                        <h4 className="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseAddress"
                            className="collapsed" aria-expanded="false">
                                <i className="fas fa-fw fa-map-marker-alt"></i> Endereços
                            </a>
                        </h4>

                        <div className="float-right col-sm-3">
                            <button type="button" className="btn btn-xs btn-block btn-outline-primary"
                            data-toggle="modal" data-target="#modalNovoEndereco"
                            onClick={() => this.replaceModalItem(null)}><i className="fas fa-fw fa-plus" /> Adicionar</button>
                        </div>

                    </div>

                    <div id="collapseAddress" className="panel-collapse in collapse">
                        <div className="card-body">

                            <div className="row">
                                {console.log(lista.length)}
                                {lista.length ? lista : <p>Esta pessoa não possui endereços cadastrados</p>}
                                <ModalEndereco
                                    id="modalEndereco"
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

                <ModalEndereco
                    id="modalNovoEndereco"
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

export default Enderecos;
