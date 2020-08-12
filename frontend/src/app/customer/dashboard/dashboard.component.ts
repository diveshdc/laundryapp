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
  public userInfoForm: FormGroup;
  public account_validation_messages = ValidationService.account_validation_messages; 

  constructor(private formBuilder:FormBuilder,private authservice: AuthService, private route: Router) { }

  ngOnInit(): void {
    this.getUserData();
    this.userInfoForm = this.formBuilder.group({
      email: ['', [Validators.required,
                  Validators.pattern("^[a-zA-Z0-9_!#$%&'*+/=? \\\"`{|}~^.-]+@[a-zA-Z0-9.-]+$"), 
                  ValidationService.avoidEmptyStrigs]],
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

  getUserData() {
    this.authservice.getUser().subscribe(async res => {
      if (res['status'] == true) {
        this.userInfoForm.controls['first_name'].setValue('oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo')
       
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
    }else{
      this.authservice.login(this.userInfoForm.value).subscribe(async res => {
        if (res['status'] == true) {
         
        } else {
          
        }
      }, (error) => {
        this.authservice.showToastrMessage('error', 'Spotlex', error.error.message);
      })
    }
  }

  findPostCode() {

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
