import React, {Component} from 'react';
import Enderecos from './endereco/list';
import Telefones from './telefone/list';

class PessoaProperties extends Component {
    constructor(props){
        super(props);

        this.state = {
            idPessoa: props.pessoa,
            baseUrl: props.baseUrl,
        };
    }

    componentDidCatch(error, errorInfo) {
      // Catch errors in any components below and re-render with error message
      console.log('componentDidCatch');
      console.log(error);
      console.log(errorInfo);
      // You can also log error messages to an error reporting service here
    }

    render() {
        return (
            <div id="accordion">
                <div className="row">

                    <Enderecos
                        pessoa={this.state.idPessoa}
                        baseUrl={this.state.baseUrl}
                    />

                    <Telefones
                        pessoa={this.state.idPessoa}
                        baseUrl={this.state.baseUrl}
                    />

                </div>
            </div>
        );
    }
}

export default PessoaProperties;
