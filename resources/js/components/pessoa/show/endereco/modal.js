import React, { Component } from 'react';
import Select from 'react-select';
import axios from 'axios';

const customStyles = {
    width: '100%'
}

class ModalEndereco extends Component {
    constructor(props) {
        super(props);

        this.state = {
            baseUrl: props.baseUrl,
            pessoa_id: props.pessoa_id,
            id: props.registro ? props.registro.id : null,
            cep: '',
            logradouro: '',
            numero: '',
            bairro: '',
            complemento: '',
            pais_id: '',
            estado_id: '',
            cidade_id: '',
            observacao: '',
            tiposEndereco: [],
            tiposEnderecoSel: null,
            paises: [],
            paisSel: null,
            estados: [],
            estadoSel: null,
            cidades: [],
            cidadeSel: null,
        }

        this.tipoEnderecoHandler = this.tipoEnderecoHandler.bind(this);
        this.paisHandler = this.paisHandler.bind(this);
        this.estadoHandler = this.estadoHandler.bind(this);
        this.cidadeHandler = this.cidadeHandler.bind(this);
        this.handleSave = this.handleSave.bind(this);
        this.getTiposEndereco = this.getTiposEndereco.bind(this);
        this.getPaises = this.getPaises.bind(this);
        this.getEstados = this.getEstados.bind(this);
        this.getCidades = this.getCidades.bind(this);
        // this.getCidade = this.getCidade.bind(this);
        this.selCidade = this.selCidade.bind(this);
        // this.handleClick = this.handleClick.bind(this);
    }

    componentWillReceiveProps(nextProps) {
        if(nextProps.registro == null){
            this.setState({
                id: null,
                cep: '',
                logradouro: '',
                numero: '',
                bairro: '',
                complemento: '',
                pais_id: '',
                estado_id: '',
                cidade_id: '',
                observacao: '',
                tiposEnderecoSel: null,
                paisSel: null,
                estados: [],
                estadoSel: null,
                cidades: [],
                cidadeSel: null,
            });

            return;
        }

        // console.log('value: ' + nextProps.registro.cidade.id + ', label: ' + nextProps.registro.cidade.nome);

        this.setState({
            // pessoa_id: nextProps.registro.pessoa_id,
            id: nextProps.registro.id,
            cep: nextProps.registro.cep,
            logradouro: nextProps.registro.logradouro,
            tipo_endereco_id: nextProps.registro.tipo_endereco_id,
            numero: nextProps.registro.numero,
            bairro: nextProps.registro.bairro,
            complemento: nextProps.registro.complemento,
            pais_id: nextProps.registro.pais_id,
            estado_id: nextProps.registro.estado_id,
            cidade_id: nextProps.registro.cidade_id,
            observacao: nextProps.registro.observacao,
            tiposEnderecoSel: {value: nextProps.registro.tipo.id, label: nextProps.registro.tipo.nome},
            paisSel: {value: nextProps.registro.cidade.estado.pais.id, label: nextProps.registro.cidade.estado.pais.nome},
            estadoSel: {value: nextProps.registro.cidade.estado.id, label: nextProps.registro.cidade.estado.nome},
            cidadeSel: {value: nextProps.registro.cidade.id, label: nextProps.registro.cidade.nome},
        });

        this.getEstados(nextProps.registro.cidade.estado.pais.id);
        this.getCidades(nextProps.registro.cidade.estado.id, nextProps.registro.cidade.estado.pais.id);
    }

    componentDidMount(){
        console.log('entrou no didmount');
        this.getTiposEndereco();
        this.getPaises();
    }

    cepHandler(e) {
        this.setState({ cep: e.target.value });
    }

    cepOnBlur(){
        axios.get(`${this.state.baseUrl}/api/getcep/${this.state.cep}`)
        .then(response => {
            // console.log(response.data);

            this.setState({ logradouro : response.data ? response.data.logradouro.trim() : ''});
            this.setState({ bairro : response.data ? response.data.bairro.trim() : ''});
            this.selCidade(response.data ? response.data.cidade : null);
        })
        .catch(error => {
            console.log('deu merda na busca de cep');
        });
    }

    getTiposEndereco(){
        // console.log(`${this.state.baseUrl}/api/listatiposendereco`);

        axios.get(`${this.state.baseUrl}/api/listatiposendereco`)
        .then(response => {

            const registros = response.data.map((item) => {
                return {value: item.id, label: item.nome};
            });

            this.setState({ tiposEndereco : registros });

            // console.log(registros);
            // console.log(typeof response.data);
            // console.log(this.state.tiposEndereco);
        })
        .catch(error => {
            console.log('deu merda na busca de tipos de endereco');
        });
    }

    tipoEnderecoHandler(e){
        // console.log("Tipo de endereço selecionado (state antes): value = " + this.state.tiposEnderecoSel.value + ', label = ' + this.state.tiposEnderecoSel.label);
        // console.log("Evento (e): " + e);
        // let valor = e ? {value: e.value, label: e.label} : null;
        // console.log("Valor (e): value = " + valor.value + ', label = ' + valor.label);
        // this.setState({ tiposEnderecoSel: valor });
        this.setState({ tiposEnderecoSel: e });
        // console.log("Tipo de endereço selecionado (state depois): value = " + this.state.tiposEnderecoSel.value + ', label = ' + this.state.tiposEnderecoSel.label);
    }

    logradouroHandler(e) {
        this.setState({ logradouro: e.target.value });
    }

    numeroHandler(e){
        this.setState({ numero: e.target.value });
    }

    bairroHandler(e){
        this.setState({ bairro: e.target.value });
    }

    complementoHandler(e){
        this.setState({ complemento: e.target.value });
    }

    paisHandler(e){
        // console.log('e.value:' + e.value + ', state.paisSel: ' + this.state.paisSel.value);

        if (e && this.state.paisSel && e.value == this.state.paisSel.value)
            return;

        this.setState({ paisSel: e });
        this.getEstados(e ? e.value : null);
        this.setState({estadoSel: null});
        this.getCidades(null);
        this.setState({cidadeSel: null});

        // console.log('Executou tudo');
    }

    getPaises(){
        // console.log(`${this.state.baseUrl}/api/listapaises`);

        axios.get(`${this.state.baseUrl}/api/listapaises`)
        .then(response => {

            const registros = response.data.map((item) => {
                return {value: item.id, label: item.nome};
            });

            this.setState({ paises : registros });

            // console.log(registros);
            // console.log(typeof response.data);
            // console.log(this.state.tiposEndereco);
        })
        .catch(error => {
            console.log('deu merda na busca de paises');
        });
    }

    estadoHandler(e){
        if (e && this.state.estadoSel && e.value == this.state.estadoSel.value)
            return;

        this.setState({ estadoSel: e });
        this.getCidades(e ? e.value : null, e ? this.state.paisSel.value : null);
        this.setState({cidadeSel: null});
    }

    getEstados(pais){

        if(pais == null){
            this.setState({ estados : [] });
            return;
        }

        let id = pais ? pais : 0;

        // console.log(`${this.state.baseUrl}/api/listaestados/${id}`);

        axios.get(`${this.state.baseUrl}/api/listaestados/${id}`)
        .then(response => {

            const registros = response.data.map((item) => {
                return {value: item.id, label: item.nome};
                // return item;
            });

            this.setState({ estados : registros });

            // console.log(registros);
            // console.log(typeof response.data);
            // console.log(this.state.tiposEndereco);
        })
        .catch(error => {
            console.log('deu merda na busca de estados');
        });
    }

    cidadeHandler(e){
        this.setState({ cidadeSel: e });
    }

    getCidades(estado, pais){

        if(estado == null) {
            this.setState({ cidades: [] });
            return;
        }

        let id = estado ? estado : 0;

        // console.log('getcidades - estado: ' + id);
        // console.log(pais ? 'getcidades - pais: ' + pais : 'getcidades - pais: null');

        // console.log(`${this.state.baseUrl}/api/listacidades/${id}`);

        axios.get(`${this.state.baseUrl}/api/listacidades/${id}/${pais}`)
        // axios.get(`${this.state.baseUrl}/api/listacidades/${id}/1`)
        .then(response => {

            const registros = response.data.map((item) => {
                return {value: item.id, label: item.nome};
            });

            this.setState({ cidades : registros });

            // console.log(registros);
            // console.log(typeof response.data);
            // console.log(this.state.tiposEndereco);
        })
        .catch(error => {
            console.log('deu merda na busca de cidades');
        });
    }

    selCidade(nomeCidade){
        // busca a cidade pelo nome, trazendo os dados do estado e do país
        // seta o pais pelo id e alimenta o combo de estado
        // seta o estado pelo id e alimenta o combo de cidades
        // seta a cidade pelos dados da raís do registro

        axios.get(`${this.state.baseUrl}/api/getcidade/${nomeCidade}`)
        .then(response => {

            let registro = response.data;

            if (registro == null)
                return;

            // console.log("cidade: " + cidade);

            // console.log("Pais: id=" + cidade.estado.pais.id + ", nome: " + cidade.estado.pais.nome);

            this.setState({
                paisSel: {value: registro.estado.pais.id, label: registro.estado.pais.nome},
                // paisSel: {value: "1", label: "Brasil"},
                estadoSel: {value: registro.estado.id, label: registro.estado.nome},
                cidadeSel: {value: registro.id, label: registro.nome},
            });

            this.getEstados(registro.estado.pais.id);
            this.getCidades(registro.estado.id, registro.estado.pais.id);
            // return response.data;

            // console.log(registros);
            // console.log(typeof response.data);
            // console.log(this.state.tiposEndereco);
        })
        .catch(error => {
            console.log('deu merda na busca da cidade pelo nome');
        });

        // let cidade = this.getCidade(nomeCidade);
        // console.log("cidade: " + cidade);

        // if (cidade == null)
        //     return;

        // console.log("cidade: " + cidade);

        // this.getEstados(cidade.estado.pais.id);
        // this.getCidades(cidade.estado.id);

        // console.log("Pais: id=" + cidade.estado.pais.id + ", nome: " + cidade.estado.pais.nome);

        // this.setState({
        //     // paisSel: {value: cidade.estado.pais.id, label: cidade.estado.pais.nome},
        //     paisSel: {value: "1", label: "Brasil"},
        //     estadoSel: {value: cidade.estado.id, label: cidade.estado.nome},
        //     cidadeSel: {value: cidade.id, label: cidade.nome},
        // });
    }

    observacaoHandler(e){
        this.setState({ observacao: e.target.value });
    }

    handleSave() {
        // const item = this.state;

        // 'pessoa_id', 'tipo_endereco_id', 'cidade_id',
        // 'logradouro', 'numero', 'complemento', 'bairro',
        // 'cep', 'observacao'

        const item = {
            id: this.state.id,
            pessoa_id: this.state.pessoa_id,
            tipo_endereco_id: this.state.tiposEnderecoSel ? this.state.tiposEnderecoSel.value : null,
            logradouro: this.state.logradouro,
            numero: this.state.numero,
            complemento: this.state.complemento,
            bairro: this.state.bairro,
            cep: this.state.cep,
            observacao: this.state.observacao,
            cidade_id: this.state.cidadeSel ? this.state.cidadeSel.value : null,
            cidade_nome: this.state.cidadeSel ? this.state.cidadeSel.label : null,
            estado_id: this.state.estadoSel ? this.state.estadoSel.value : null,
            estado_nome: this.state.estadoSel ? this.state.estadoSel.label : null,
            pais_id: this.state.paisSel ? this.state.paisSel.value : null,
        };

        console.log('Item do modal: ');
        console.log(item);

        axios.post(`${this.state.baseUrl}/api/endereco`, item)
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

    // handleClick(){
    //     console.log(this.state.paisSel);
    //     console.log(this.state.estadoSel);
    //     console.log(this.state.cidadeSel);
    // }

    render() {

        // const {tipo_endereco_id} = this.state.tipo_endereco_id;

        return (
            <div className="modal fade" id={this.props.id} tabIndex="-1" role="dialog" aria-labelledby="modalEnderecoLabel" aria-hidden="true">
                <div className="modal-dialog modal-default" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h4 className="modal-title" id="modalEnderecoLabel">Endereço</h4>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-body">
                            {/* <form onSubmit={this.handleSave} id="formEndereco"> */}
                                <div className="row">
                                    <div className="col-sm-5">
                                        <div className="form-group">
                                            <label htmlFor="cep">CEP</label>
                                            <input type="text" className="form-control" name="cep" id="cep" maxLength="20" placeholder="" autoFocus
                                            value={this.state.cep} onChange={(e) => this.cepHandler(e)} onBlur={() => this.cepOnBlur()} />
                                        </div>
                                    </div>
                                    <div className="col-sm-7" data-select2-id="2">
                                        <div className="form-group">
                                            <label htmlFor="tipo_endereco_id">Tipo</label>
                                            <Select
                                                className="basic-single"
                                                classNamePrefix="select"
                                                value={this.state.tiposEnderecoSel}
                                                // defaultValue={this.state.tiposEndereco[0]}
                                                styles={customStyles}
                                                placeholder="Selecione um tipo de endereço"
                                                isClearable={true}
                                                isSearchable={true}
                                                name="tipo_endereco_id"
                                                options={this.state.tiposEndereco}
                                                onChange={this.tipoEnderecoHandler}
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div className="row">
                                    <div className="col-sm-10">
                                        <div className="form-group">
                                            <label htmlFor="msg">Logradouro</label>
                                            <input type="text" className="form-control" name="logradouro" id="logradouro" maxLength="20"
                                            value={this.state.logradouro} onChange={(e) => this.logradouroHandler(e)} placeholder="" required/>
                                        </div>
                                    </div>

                                    <div className="col-sm-2">
                                        <div className="form-group">
                                            <label htmlFor="numero">Número</label>
                                            <input type="text" className="form-control" name="numero" maxLength="20" placeholder=""
                                            value={this.state.numero?this.state.numero:''} onChange={(e) => this.numeroHandler(e)} />
                                        </div>
                                    </div>
                                </div>

                                <div className="row">
                                    <div className="col-sm-6">
                                        <div className="form-group">
                                            <label htmlFor="bairro">Bairro</label>
                                            <input type="text" className="form-control" name="bairro" id="bairro" maxLength="150" placeholder=""
                                            value={this.state.bairro?this.state.bairro:''} onChange={(e) => this.bairroHandler(e)} />
                                        </div>
                                    </div>
                                    <div className="col-sm-6">
                                        <div className="form-group">
                                            <label htmlFor="complemento">Complemento</label>
                                            <input type="text" className="form-control" name="complemento" id="complemento" maxLength="200" placeholder=""
                                            value={this.state.complemento?this.state.complemento:''} onChange={(e) => this.complementoHandler(e)} />
                                        </div>
                                    </div>
                                </div>

                                <div className="row">
                                    <div className="col-sm-6" data-select2-id={1}>
                                        <div className="form-group">
                                            <label htmlFor="pais_id">País</label>
                                            <Select
                                                className="basic-single"
                                                classNamePrefix="select"
                                                value={this.state.paisSel}
                                                styles={customStyles}
                                                placeholder="Selecione um país"
                                                isClearable={true}
                                                isSearchable={true}
                                                name="pais_id"
                                                options={this.state.paises}
                                                onChange={this.paisHandler}
                                            />
                                        </div>
                                    </div>
                                    <div className="col-sm-6" data-select2-id={2}>
                                        <div className="form-group">
                                            <label htmlFor="estado_id">Estado</label>
                                            <Select
                                                className="basic-single"
                                                classNamePrefix="select"
                                                value={this.state.estadoSel}
                                                styles={customStyles}
                                                placeholder="Selecione um estado"
                                                isClearable={true}
                                                isSearchable={true}
                                                name="estado_id"
                                                options={this.state.estados}
                                                onChange={this.estadoHandler}
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div className="row">
                                    <div className="col-sm-12" data-select2-id={3}>
                                        <div className="form-group">
                                            <label htmlFor="cidade_id">Cidade</label>
                                            <Select
                                                className="basic-single"
                                                classNamePrefix="select"
                                                value={this.state.cidadeSel}
                                                styles={customStyles}
                                                placeholder="Selecione uma cidade"
                                                isClearable={true}
                                                isSearchable={true}
                                                name="cidade_id"
                                                options={this.state.cidades}
                                                onChange={this.cidadeHandler}
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div className="row">
                                    <div className="col-sm-12">
                                        <div className="form-group">
                                            <label htmlFor="observacao">Observação</label>
                                            <textarea name="observacao" className="form-control" rows="3" maxLength="300" placeholder=""
                                            value={this.state.observacao?this.state.observacao:''} onChange={(e) => this.observacaoHandler(e)} />
                                        </div>
                                    </div>
                                </div>

                            {/* </form> */}
                        </div>

                        <div className="modal-footer justify-content-between">
                            <button type="button" className="btn btn-outline-default" data-dismiss="modal">Fechar</button>
                            <button type="button" className="btn btn-outline-primary" data-dismiss="modal" 
                            onClick={() => { this.handleSave() }} id="salvarEndereco">Salvar</button>
                            {/* <button type="button" className="btn btn-primary" onClick={() => { this.handleClick() }} id="verState">Ver State</button> */}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default ModalEndereco;
