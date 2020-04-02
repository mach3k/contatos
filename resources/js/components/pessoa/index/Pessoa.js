import React, { Component } from 'react';

class Pessoa extends Component {

    render() {
        return (
            <div className="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div className="card bg-light w-100">
                    <div className="card-header text-muted border-bottom-0">
                            {this.props.pessoa.cargo}
                    </div>
                    <div className="card-body pt-0">
                        <div className="row">
                        <div className="col-7">
                            <h2 className="lead"><b>{this.props.pessoa.nome}</b></h2>

                            <p className="text-muted text-sm"><b>À serviço de: </b><br /> {this.props.pessoa.empregador.nome} </p>

                        </div>
                        <div className="col-5 text-center">
                            <img src="{{asset('storage/images/sem_foto.png')}}" alt className="img-circle img-fluid" />
                        </div>
                        </div>
                        <div className="row">
                        <ul className="ml-4 mb-0 fa-ul text-muted">
                            <li className="small">
                            <span className="fa-li">
                                <i className="fas fa-sm fa-map-marker-alt" /> </span>
                                {this.props.pessoa.endereco.logradouro}, {this.props.pessoa.endereco.numero} - {this.props.pessoa.endereco.cidade.nome} / {this.props.pessoa.endereco.cidade.estado.sigla}
                            </li>
                            <li className="small">
                            <span className="fa-li"><i className="fas fa-sm fa-phone" /> </span>
                            ({this.props.pessoa.telefone.ddd}) {this.props.pessoa.telefone.numero}
                            </li>
                        </ul>
                        </div>
                    </div>
                    <div className="card-footer">
                        <div className="text-right">
                        <a href="{{route('pessoa.show', $registro->id)}}" className="btn btn-sm btn-primary">
                            <i className="fas fa-user" /> Ver Perfil
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Pessoa;
