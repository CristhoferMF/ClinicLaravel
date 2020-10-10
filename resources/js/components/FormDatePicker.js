import React,{Fragment, useState} from 'react'
import ReactDOM from 'react-dom';
import { registerLocale } from  "react-datepicker";
import es from 'date-fns/locale/es';

import DatePicker from "react-datepicker";

import "react-datepicker/dist/react-datepicker.css";

registerLocale('es', es)

const FormDatePicker = ({data}) => {

    console.log(data.isInvalid);

    const CustomInput = ({value,onClick}) => {
        return (<input type="text" 
            className={(data.isInvalid ? "is-invalid " :"" )+"d-block form-control react-datepicker-ignore-onclickoutside"}
            defaultValue={value}
            name="born_date"
            autoComplete="off"
            placeholder="Fecha de Nacimiento"
            onFocus={onClick} />)
    }

    const [startDate, setStartDate] = useState((data.oldValue) ? Date.parse(data.oldValue + " 00:00:00") : null);
    
    return (
    <Fragment>
      <DatePicker 
        selected={startDate}
        locale="es"
        placeholderText="Fecha de nacimiento"
        peekNextMonth
        showMonthDropdown
        showYearDropdown
        dropdownMode="select"
        dateFormat="dd/MM/yyyy"
        maxDate={new Date()}
        customInput={<CustomInput />}
        onChange={date => setStartDate(date)} />
    </Fragment>
    );
};

if(document.getElementById('datepicker-container')){
    var data = document.getElementById('datepicker-container').getAttribute('data');
    ReactDOM.render(<FormDatePicker data={JSON.parse(data)}/>, document.getElementById('datepicker-container'));
}