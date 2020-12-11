import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Card from 'react-bootstrap/Card';
import { parseISO, format } from 'date-fns';
import pt from 'date-fns/locale/pt';
import { useAccordionToggle } from 'react-bootstrap/AccordionToggle';
import PessoaModal from './PessoaModal';
import PessoaProperties from './pessoaproperties';
import axios from 'axios';
import ModalImage from "react-modal-image-fragment";

// import pt from 'date-fns/locales/pt';

class PessoaCard extends Component {
    constructor(props) {
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
        console.log(this.state.pessoa);
    }

    // showModal = () => {
    //   this.setState({ show: true });
    // };

    // hideModal = () => {
    //   this.setState({ show: false });
    // };

    dataFormatada(data) {
        // console.log(data);
        // let temp = new Date(Date.parse(data));
        let temp = new parseISO(data + ' 00:00:00');
        // let temp2 =  zonedTimeToUtc(temp, 'America/Sao_Paulo');
        // return format(temp2, 'dd/MM/yyyy');
        // return format(temp, 'dd/MM/yyyy', {timeZone: 'America/Sao_Paulo'});
        return format(temp, 'dd/MM/yyyy', { locale: pt });
    }

    cpfFormatado(idPessoa) {
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
                <div className="row">
                    <div className="col-sm-3">
                        <div className="">
                            <ModalImage
                                className="img-cicle pad"
                                small={'https://aautio.github.io/react-modal-image/example_img_small.jpg'}
                                large={'https://aautio.github.io/react-modal-image/example_img_small.jpg'}
                                alt="Hello World!"
                                hideDownload={true}
                                hideZoom={true}
                            />
                        </div>
                    </div>
                </div>
                <div className="row">
                    <div className="col-sm-3">
                        <div className="widget-user-image">
                            <ModalImage
                                className="img-circle"
                                small={'https://aautio.github.io/react-modal-image/example_img_small.jpg'}
                                large={'https://aautio.github.io/react-modal-image/example_img_small.jpg'}
                                alt="Hello World!"
                                hideDownload={true}
                                hideZoom={true}
                            />
                        </div>
                    </div>
                </div>
                <div className="row">
                    <div className="col-sm-3">
                        <div className="widget-user-image">
                            <img className="img-circle" src="https://aautio.github.io/react-modal-image/example_img_small.jpg"
                                alt="Nada" />
                        </div>
                    </div>
                </div>


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
