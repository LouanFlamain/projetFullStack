import React, { useContext } from "react";
import { Routes, Route, BrowserRouter } from "react-router-dom";
import { context } from "./context/context";
import Config from "./pages/config";
import Equilibre from "./pages/equilibre";
import Depense from "./pages/depense";
import Login from "./pages/login";
import Register from "./pages/register";
import CreateTenant from "./pages/createTenant";
import CreateRental from "./pages/createRental";
import NeedAuth from "./component/needAuth";

function App() {
  const { setLogged, logged } = useContext(context);
  return (
    <BrowserRouter>
      <div className="App">
        <Routes>
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
          <Route
            path="/config"
            element={
              <NeedAuth>
                <Config />
              </NeedAuth>
            }
          />
          <Route
            path="/depense"
            element={
              <NeedAuth>
                <Depense />
              </NeedAuth>
            }
          />
          <Route
            path="/equilibre"
            element={
              <NeedAuth>
                <Equilibre />
              </NeedAuth>
            }
          />
          <Route
            path="/createTenant"
            element={
              <NeedAuth>
                <CreateTenant />
              </NeedAuth>
            }
          />
          <Route
            path="/Createrental"
            element={
              <NeedAuth>
                <CreateRental />
              </NeedAuth>
            }
          />
        </Routes>
      </div>
    </BrowserRouter>
  );
}

export default App;
