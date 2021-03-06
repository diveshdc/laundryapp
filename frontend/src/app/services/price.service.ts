import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class PriceService {
  public apiUrl = 'http://3.11.134.243';
  constructor( private http: HttpClient) {
    this.apiUrl = 'http://3.11.134.243';
   }

   /*
  * API for Get Pricing
  *
  */
 getPriceList() {
  return this.http.get(this.apiUrl + '/api/admin/pricelist/');
}

  /*
  * API for Get Pricing
  *
  */
 addToCart(cartData) {
  return this.http.post(this.apiUrl + '/api/add_and_remove_cart/', cartData);
}

}
