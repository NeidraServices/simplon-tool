import { BehaviorSubject } from "rxjs";
import { Role } from '../helpers/role';
import { requestOptions } from "../helpers/request-options";
import { handleResponse } from "../helpers/handle-response";


const currentUserSubject = new BehaviorSubject(
  JSON.parse(localStorage.getItem('vuex'))
);

const roleSubject = new BehaviorSubject(
  JSON.parse(localStorage.getItem('role'))
);

export const authenticationService = {
  connected,
  login,
  logout,
  isAdmin,
  passwordReset,
  role: roleSubject.asObservable(),
  userLoggedIn: currentUserSubject.asObservable(),
  get currentRoleValue() {
    return roleSubject.value;
  }
};

function connected() {
  const role = localStorage.getItem("role");
  return !_.isNull(role)
}

function login(user) {
  return fetch(
    `/api/connexion`,
    requestOptions.post(user)
  )
    .then(handleResponse)
    .then(data => {
      // store user details and jwt token in local storage to keep user logged in between page refreshes
      localStorage.setItem("role", JSON.stringify(data.informations.role));
      roleSubject.next(data.informations.role);

      return data;

    });
}


function passwordReset(user) {
  return fetch(
    `/password/reset`,
    requestOptions.post(user)
  )
    .then(handleResponse)
    .then(({ data }) => {
      // store user details and jwt token in local storage to keep user logged in between page refreshes
      localStorage.setItem("role", JSON.stringify(data.informations.role));
      roleSubject.next(data.informations.role);

      return data;
    });

}

function logout() {
  // remove user from local storage to log user out
  localStorage.removeItem('token');
  localStorage.removeItem('role');
  this.$store.commit('disconnect');
  this.$router.push('/');
}

function isAdmin() {
  return role() === Role.Admin;
}

function role() {
  let role = localStorage.getItem('role');
  if (!role) {
    return null;
  }
  role = JSON.parse(role);
  return role;
}