import axios from './axios';
import { upperCase } from 'lodash';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import FormDayAvailability from './components/FormDayAvailabilty';

const URL_SPECIALTIES = document.getElementById('URL_SPECIALTIES').value;
const ARRAY_DAYS = ['DOM','LUN','MAR','MIE','JUE','VIE','SAB'];

function removeItemFromArr ( arr, item ) {
    var i = arr.indexOf( item );
 
    if ( i !== -1 ) {
        arr.splice( i, 1 );
    }
}

class Example extends Component {
    
    constructor(props){
        super(props);
        this.state={
            doctors:[],
            clinics:[],
            specialties:[],
            doctor_id:'',
            clinic_id:'',
            specialty_id:'',
            days : []
        }
        this.handleChange = this.handleChange.bind(this);
        this.handleChangeClinic = this.handleChangeClinic.bind(this);
        this.specialtySelectRef = React.createRef();
        this.handleChangeDay = this.handleChangeDay.bind(this);
    }

    componentDidMount(){
        const doctors = JSON.parse(document.getElementById('doctors-json').value);
        const clinics = JSON.parse(document.getElementById('clinics-json').value);
        this.setState({doctors,clinics,doctor_id:doctors[0].id})
    }

    handleChange(e){
        this.setState({[e.target.name]:e.target.value});
    }
    
    handleChangeClinic(e){
        const clinic_id = e.target.value;
        const selectSpecialties = this.specialtySelectRef.current

        this.setState({clinic_id,specialties:[]});
        selectSpecialties.setAttribute('disabled',true);

        if(clinic_id){
            axios.get(URL_SPECIALTIES.replace('_id',clinic_id))
                .then( ({data:specialties}) => {
                    this.setState({specialties})
                    selectSpecialties.removeAttribute('disabled')
                })
        }

    }

    handleChangeDay(e){
        const indexDay = e.target.getAttribute('data-day');
        const {days} = this.state

        if(days.includes(indexDay)){
            var confirm = window.confirm('Se perderan los datos del formulario. ¿Desea ocultar el formulario?');
            if(confirm){
                removeItemFromArr(days,indexDay)
                e.target.classList.remove('active')
                e.target.classList.add('text-gray-700')
            }
           
        }else{
            days.push(indexDay);
            e.target.classList.add('active')
            e.target.classList.remove('text-gray-700')
        }

        this.setState({days});
    }

    render(){

        const {doctor_id,specialty_id,clinic_id,specialties,doctors,clinics} = this.state

        return (
            <div>
                <div className="form-group row">
                    <div className="col-12">
                        <label htmlFor="doctor_id" >Doctor</label>  
                        <select className="form-control" id="doctor_id" name="doctor_id" value={doctor_id} 
                            onChange={this.handleChange}>
                            {
                                doctors.map( (doctor,index) => {
                                    return <option key={index} value={doctor.id}>{upperCase(doctor.document_number)+" - "+upperCase(doctor.last_name+" "+doctor.first_name)}</option>
                                })
                            }
                        </select>
                    </div>
                </div>
                <div className="form-group row">
                    <div className="col-md-6">
                        <select className="form-control" name="clinic_id" value={clinic_id} 
                            onChange={this.handleChangeClinic}>
                            <option value="">Sede</option>
                            {
                                clinics.map( (clinic,index) =>{
                                    return <option value={clinic.id}>{clinic.name}</option>
                                })
                            }
                        </select>
                    </div>
                    <div className="col-md-6">
                        <select ref={this.specialtySelectRef} disabled className="form-control" name="specialty_id" 
                            value={specialty_id} onChange={this.handleChange}>
                            <option value="">Especialidad</option>
                            {
                                specialties.map( (specialty,index) =>{
                                    return <option value={specialty.id}>{specialty.name}</option>
                                })
                            }
                        </select>
                    </div>
                </div>
                <div className="form-group row">
                    <div className="col-12 d-flex">
                        {
                            ARRAY_DAYS.map( (day,indexDay) => {
                                return <button data-day={indexDay} onClick={this.handleChangeDay} className="btn btn-sm btn-outline-info rounded-0 text-gray-700" style={{flex:1}}>{day}</button>
                            })
                        }
                    </div>
                </div>
                <hr></hr>
                <div className="mt-5">
                        {
                            this.state.days.map( (day,index) => {
                                return <FormDayAvailability day={day} doctor_id={doctor_id} specialty_id={specialty_id} />
                            })
                        }
                </div>
            </div>
        );
    }
}


if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
