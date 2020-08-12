import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';
import { HttpClient } from '@angular/common/http';
// import { MessageService } from 'primeng/api';
import { ROUTER_CONFIGURATION } from '@angular/router';
@Injectable({
  providedIn: 'root'
})
export class AuthService {

  public apiUrl: string = environment.url;
  constructor( private http: HttpClient) {
    this.apiUrl = environment.url;
   }

   /*
  * API for Manage Users
  *
  */
  getUser() {
    return this.http.get(this.apiUrl + '/api/user');
  }
   /*
  * API for Manage Users
  *
  */
//  getUserById() {
//   return this.http.get(this.apiUrl + '/api/user');
// }



  userLogout() {
    return this.http.get(this.apiUrl + '/api/auth/logout');
  }

  login(loginData) {
    return this.http.post(this.apiUrl + '/api/login',loginData);
  }



  /**
   * Function to show toastr message
   * @param status
   * @param summary
   * @param detail
   */
  async showToastrMessage(status, summary, detail) {
    // await this.messageService.add({
    //   severity: status,
    //   summary: summary,
    //   detail: detail
    // });
  }
}
