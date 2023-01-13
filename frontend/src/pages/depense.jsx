import React, { useState } from "react";
import { Link } from "react-router-dom";
import { Modal, Button, Form } from "react-bootstrap";
import Header from "../component/header";
import CreateCost from "../component/createCost";
import { Link } from "react-router-dom";

function AddParticipantModal(props) {
  const [show, setShow] = useState(false);
  const submit = (event) => {
    event.preventDefault();
  };

  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);

  return (
    <>
      <Button variant="mt-4 pt-4 text-primary" onClick={handleShow}>
        <u>Ajouter un participant</u>
      </Button>

      <Modal show={show} onHide={handleClose} centered>
        <Modal.Header closeButton>
          <Modal.Title>Ajouter un participant</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <Form onSubmit={submit} method="POST" action="">
            <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
              <Form.Label>E-mail</Form.Label>
              <Form.Control type="email" />
            </Form.Group>
          </Form>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleClose}>
            Ok,
          </Button>
          <Button type="submit" variant="primary" onClick={handleClose}>
            Annuler
          </Button>
        </Modal.Footer>
      </Modal>
    </>
  );
}
export default function Cost() {
  const [show, setShow] = useState(false);

  return (
    <>
      <Header />
        <div className="create-wrapper pt-0 p-3">

      <p className="bg-primary p-2 text-white text-end">
        {/* rendre le prénom de l'user.id */}
        Vous êtes identifié comme <em>'Le nom de l'identifié'</em>
      </p>

      {/* rendre les dépenses existentes */}
      <div className="p-3">Ceci est la page dépense</div>

      {/* doit faire apparaitre createCost si le user clique sur "créer une dépense" */}
      <CreateCost />
      
    </div>
      <form className="card-body p-5">
        <div className="form-group row p-2 w-25">
          <label
            for="what"
            className="col-sm-2 col-form-label col-form-label-sm"
          >
            Quoi :
          </label>

          <div className="col-sm-10">
            <input
              type="text"
              className="form-control form-control-sm" //
              id="what"
            />
          </div>

          <div className="col-md-6 row mb-3">
            <div className="col-10">
              <div clasNames="input-group-prepend"></div>
              <select className="custom-select" id="">
                <option selected>Dépense</option>
                <option selected>Rentrée d'argent</option>
                <option selected>Transfert d'argent</option>
              </select>
            </div>
          </div>

          <Link to="/">(Plus d'info)</Link>
        </div>

        <div className="form-group row p-2">
          <label
            for="who paid"
            className="col-sm-2 col-form-label col-form-label-sm"
          >
            Qui a payé :
          </label>

          <div className="col-md-6 row mb-3">
            <div className="col-10">
              <div clasNames="input-group-prepend"></div>
              <select className="custom-select" id="">
                <option selected>Deva</option>
                <option selected>Jessica</option>
                <option selected>Rayan</option>
              </select>
            </div>
          </div>

          <div>
            <Link to="/">Ajouter un participant</Link>
          </div>

          <div className="form-group row p-2 w-25">
            <label for="date" className="col-sm-2 col-form-label-sm">
              Date (facultatif) :
            </label>

            <div className="col-sm-10">
              <input
                type="date"
                id="date"
                className="form-control form-control-sm "
              />
            </div>
          </div>

          <div className="form-group row p-2 w-25">
            <label
              for="amount"
              className="col-sm-2 col-form-label col-form-label-sm"
            >
              Montant :
            </label>

            <div className="col-sm-10">
              <input
                type="text"
                className="form-control form-control-sm "
                id="amount"
              />
            </div>
          </div>

          <div>
            <p>
              Pour qui était la dépense : <Link to="/détails">Détails</Link>
            </p>
          </div>

          <div className="solid">
            <p></p>
          </div>
          <div className="AddParticipantModal">
            <AddParticipantModal show={show} onHide={() => setShow(false)} />
          </div>
          <div className="solid">
            <p></p>
          </div>
          <div className="solid">
            <p></p>
          </div>
        </div>
      </form>
        <div className="p-2 bg-primary mt-auto">
          <Link to="/depense">
              <button className="btn mb-0 text-white"><u>Créer une dépense</u></button>
          </Link>
      </div>
    </>
  );
}
