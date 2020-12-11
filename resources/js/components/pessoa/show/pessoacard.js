import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import Card from 'react-bootstrap/Card';
import {parseISO, format} from 'date-fns';
import pt from 'date-fns/locale/pt';
import { useAccordionToggle } from 'react-bootstrap/AccordionToggle';
import PessoaModal from './PessoaModal';
import PessoaProperties from './pessoaproperties';
import axios from 'axios';

// import pt from 'date-fns/locales/pt';

class PessoaCard extends Component {
    constructor(props){
        super(props);

        // console.log(props.baseUrl);
        // console.log(props.registro);

        this.state = {
            pessoa: props.registro,
            baseUrl: props.baseUrl,
            naoInformado: 'Não informado',
            show: false
        };

        this.dataFormatada = this.dataFormatada.bind(this);
        this.cpfFormatado = this.cpfFormatado.bind(this);
    }

    componentDidMount() {
        // console.log(this.state.pessoa);
    }

    // showModal = () => {
    //   this.setState({ show: true });
    // };

    // hideModal = () => {
    //   this.setState({ show: false });
    // };

    dataFormatada(data){
        // console.log(data);
        // let temp = new Date(Date.parse(data));
        let temp = new parseISO(data + ' 00:00:00');
        // let temp2 =  zonedTimeToUtc(temp, 'America/Sao_Paulo');
        // return format(temp2, 'dd/MM/yyyy');
        // return format(temp, 'dd/MM/yyyy', {timeZone: 'America/Sao_Paulo'});
        return format(temp, 'dd/MM/yyyy', {locale: pt});
    }

    cpfFormatado(idPessoa){
        // console.log(`${this.state.baseUrl}/api/cpfformatado/${idPessoa}`);

        axios.get(`${this.state.baseUrl}/api/cpfformatado/${idPessoa}`)
        .then(response => {

            // console.log('cpf formatado: ' + response.data);
            // return response.data;
            var elemento = document.getElementById("cpf");
            elemento.innerHTML = response.data;
            // return response.data;
        })
        .catch(error => {
            console.log('deu merda no cpf');
        });
    }

    render() {
        return (
            <div>
                <Card>
                    <Card.Header className="card-header">
                        <h3 className="card-title">{this.state.pessoa.nome}</h3>
                        <div className="float-right">
                            <button type="button" className="btn btn-xs btn-outline-warning" ><i className="far fa-fw fa-edit" /> Editar</button> {/* onClick={() => setModalShow(true)}*/}
                        </div>
                    </Card.Header>

                    <Card.Body className="card-body">
                        <div>
                            <div className="row">
                                <div className="col-sm-4">
                                {/* {typeof this.state.pessoa.foto !== 'undefined' ?
                                    // <img className="img-fluid pad" src={this.state.baseUrl + '/storage/pessoas/' + this.state.pessoa.foto.nome} alt="Photo"/>
                                    <img className="img-fluid pad" src={this.state.baseUrl + '/storage/images/sem_foto.png'} alt="Photo" />
                                    :
                                    <img className="img-fluid pad" src={this.state.baseUrl + '/storage/images/sem_foto.png'} alt="Photo" />
                                } */}
                                    <button type="button" className="btn btn-block btn-secondary btn-xs" data-toggle="modal" data-target="#modalFoto"><i className="fas fa-fw fa-camera" /> Enviar foto</button>
                                </div>

                                <div className="col-sm-4">
                                    <dl>
                                        <dt>Nome</dt>
                                        <dd>{this.state.pessoa.nome}</dd>
                                        <dt>Nome Social</dt>
                                        <dd>{this.state.pessoa.nomeSocial}{this.state.pessoa.utilizaNomeSocial ? ' (utiliza nome social)' : ''}</dd>
                                        <dt>Data de nascimento</dt>
                                        <dd>{this.dataFormatada(this.state.pessoa.dataNascimento)}</dd>
                                        <dt>Gênero</dt>
                                        <dd>{typeof this.state.pessoa.genero !== 'undefined' ?
                                        this.state.pessoa.genero.nome : this.state.naoInformado}</dd>
                                    </dl>
                                </div>

                                <div className="col-sm-4">
                                    <dl>
                                        <dt>Empresa</dt>
                                        <dd>{this.state.pessoa.empregador ? this.state.pessoa.empregador.nome : this.state.naoInformado}</dd>

                                        <dt>Cargo</dt>
                                        <dd>{this.state.pessoa.cargo ? this.state.pessoa.cargo : this.state.naoInformado}</dd>

                                        <dt>CPF</dt>
                                        <dd>{this.state.pessoa.cpf_cnpj ? this.cpfFormatado(this.state.pessoa.id) : this.state.naoInformado}<span id="cpf"></span></dd>

                                        <dt>RG</dt>
                                        <dd>{this.state.pessoa.rg_ie ? this.state.pessoa.rg_ie : this.state.naoInformado}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <hr />

                        <PessoaProperties pessoa={this.state.pessoa.id} baseUrl={this.state.baseUrl}/>

                        {/* <Card>
                            <Card.Header>
                                <Accordion.Toggle as={Button} variant="link" eventKey="1">
                                    Click me!
                                </Accordion.Toggle>
                            </Card.Header>
                            <Accordion.Collapse eventKey="1">
                                <Card.Body>Hello! I'm another body</Card.Body>
                            </Accordion.Collapse>
                        </Card> */}

                    </Card.Body>

                    <Card.Footer>

                    </Card.Footer>
                </Card>

                {/* <PessoaModal
                    show={modalShow}
                    onHide={() => setModalShow(false)}
                /> */}
            </div>
        );
    }
}

export default PessoaCard;

var elemento = document.getElementById('PessoaCard');
if (elemento) {
    var registro = JSON.parse(elemento.getAttribute('registro'));
    var baseUrl = elemento.getAttribute('baseUrl');
    ReactDOM.render(<PessoaCard registro={registro} baseUrl={baseUrl} />, elemento);
}
