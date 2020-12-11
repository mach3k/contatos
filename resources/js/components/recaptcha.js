import React from 'react';
import ReactDOM from 'react-dom';
import ReCAPTCHA from "react-google-recaptcha";


const Recaptcha = props => {

    const onChange = (value) => {
        console.log("Captcha value:", value);
    }

    return (
        <ReCAPTCHA
            sitekey="6LczhrkZAAAAAL9y51HugAd0kmauMtWfvfgV2XaW"
            onChange={onChange}
        />
    )
}

export default Recaptcha;

var elemento = document.getElementById('recaptchulinha');
console.log('elemento: ', elemento);
if (elemento) {
    ReactDOM.render(<Recaptcha />, elemento);
}