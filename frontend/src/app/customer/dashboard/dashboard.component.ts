import { Component, OnInit } from '@angular/core';
import { AuthService } from 'app/services/auth.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ValidationService } from '../../services/validation.service'
@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {
   userInfoForm: FormGroup;
  public account_validation_messages = ValidationService.account_validation_messages;
  showSupport: Boolean = false;
  loyalityPoint: any;
  userId: any;
  allOrders: any;
  orderDetail: any;
  Coupons: any;
  constructor(private formBuilder: FormBuilder, private authservice: AuthService, private route: Router) {
    this.userInfoForm = this.formBuilder.group({
      email: ['', [Validators.required,
                   Validators.pattern('^[a-zA-Z0-9_!#$%&\'*+/=? \\"`{|}~^.-]+@[a-zA-Z0-9.-]+$'),
                   ValidationService.avoidEmptyStrigs]
                  ],
      password : ['', [Validators.required, Validators.minLength(6)]],
      postcode : ['', [Validators.required]],
      address : ['', [Validators.required]],
      new_password : ['', [Validators.required, Validators.minLength(6)]],
      password_confirmation : ['', [Validators.required, Validators.minLength(6)]],
      first_name : ['', [Validators.required]],
      last_name : ['', [Validators.required]],
      phone_number : ['', [Validators.required, Validators.minLength(10)]],
      street_name : ['', [Validators.required]],
      town : ['', [Validators.required]],
      building_name_no : ['', [Validators.required]],
      });
   }

  ngOnInit(): void {
    this.getUserData();
  }

  getUserData() {
    this.authservice.getUser().subscribe(async res => {
      if (res['status'] === true) {
        this.loyalityPoint = res['data'].loyalty_point
        this.userId = res['data'].id
        this.userInfoForm.patchValue(res['data'])
      } else {

      }
    }, (error) => {
      this.authservice.showToastrMessage('error', 'Spotlex', error.error.message);
    })
  }

  updateUserInfo() {
    if (this.userInfoForm.invalid) {
      this.validateAllFormFields(this.userInfoForm);
      return true;
    } else {
      this.authservice.login(this.userInfoForm.value).subscribe(async res => {
        if (res['status'] === true) {
          this.authservice.showToastrMessage('success', 'Spotlex', res['message']);
        } else {
        }
      }, (error) => {
        this.authservice.showToastrMessage('error', 'Spotlex', error.error.message);
      })
    }
  }

  findPostCode() {

  }

  showChat() {
    this.showSupport = true;
  }

  closeChat() {
    this.showSupport = false;
  }

  getCouponVoucher() {
    this.authservice.getCoupon().subscribe(async res => {
      if (res['status'] === true) {
        this.Coupons = res['data']
      } else {
      }
    }, (error) => {
      this.authservice.showToastrMessage('error', 'Spotlex', error.error.message);
    })
  }

  getAccountSetting() {

  }

  viewOrderDetail(orderId) {
    const result = this.allOrders.filter(element => {
      if (element.id === orderId) {
       return true;
      }
     });
     console.log(result[0])
     this.orderDetail = result[0]
  }

  getOrderHistory() {
    this.authservice.getOrderHistory({'user_id': this.userId}).subscribe(async res => {
      if (res['status'] === true) {
        this.allOrders = res['currentOrders']
        this.authservice.showToastrMessage('success', 'Spotlex', res['message']);
      } else {
      }
    }, (error) => {
      this.authservice.showToastrMessage('error', 'Spotlex', error.error.message);
    })
  }
  /**
   * Function to validate all form fields
   * @param formGroup
   */
  validateAllFormFields(formGroup: FormGroup) {
    Object.keys(formGroup.controls).forEach(field => {
      const control = formGroup.get(field);
      control.markAsTouched({ onlySelf: true });
      control.markAsDirty({ onlySelf: true });
    });
  }

}
