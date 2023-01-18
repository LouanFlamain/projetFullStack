import axios from "axios";
import React, { useState , useContext } from 'react';
import { useNavigate } from "react-router-dom";
import Header from "../component/header";
import { context } from "../context/context";


export default function CreateRental(props) {
  const { logged, setLogged } = useContext(context);
  const [location, setLocation] = useState("");
  const [description, setDescription] = useState("");
  const [amount, setAmount] = useState(0);
  const navigate = useNavigate();


  const submit = (event) => {
    console.log('test')
    event.preventDefault();
      const data = {
        data: {
          type: "Rental",
          attributes: {
            title: location,
            amount: amount,
            description: description,
          },
        },
      };
      axios({
        method: "post",
        url: "http://localhost:5656/rental",
        data: JSON.stringify(data),
        withCredentials: true,
        credentials: 'same-origin',
      })
        .then(function (response) {
        if(response.data.rental === true){
          navigate("/createTenant")
        } 
      })
      .catch(error => {
      });
  };

  return (
    <>
    <Header />
    <p className="bg-primary p-2 text-white text-end">
          {/* rendre le prénom de l'user.id */}
          Vous êtes identifié comme <em>{logged.username}</em>
    </p>
    <div className="create-wrapper p-3">
      <p className="h4 p-4 text-primary">Creer la location (Etape 1 sur 2)</p>
      <div>
          <p className="p-2 bg-primary text-white">
            Choisissez un titre explicite et donnez plus d'informations dans la description
          </p>
      </div>
      {/* vérifier si ce n'est pas méthode POST */}
      <form method="POST" onSubmit={submit}>

        <div className="p-4">
          <div className="form-group row p-2">

            <label htmlFor="title" className="col-sm-2 col-form-label col-form-label-sm">Nom de la location:</label>
            

            <div className="col-sm-10 ">

            <input onChange={(e) => {setLocation(e.target.value)}} type="text"  className="form-control form-control-sm" id="title"/>

            </div>

          </div>
        

          <div className="form-group row p-2">

            <label htmlFor="description" className="col-sm-2 col-form-label col-form-label-sm">Description:</label>
            

            <div className="col-sm-10 ">

            <textarea onChange={(e) => {setDescription(e.target.value)}} className="form-control" id="description" rows="3"></textarea>

            </div>

          </div>

          <div className="form-group row p-2">

            <label htmlFor="rent" className="col-sm-2 col-form-label col-form-label-sm">Montant du loyer:</label>
            

            <div className="col-sm-10">

            <input onChange={(e) => {setAmount(e.target.value) }} type="number" className="form-control form-control-sm " id="rent"/>

            </div>

          </div>
        </div>
        <div className="p-2 bg-primary mt-auto">
            <button type="submit" className="btn text-white">Continuer</button>
        </div>
      </form>
      

    </div>
    
    </>
    );
  }
