var eForm=document.querySelector("#empForm");
var DeptID=document.querySelector("#deptID");
var empID=document.querySelector("#EmployeeID");
var empName=document.querySelector("#EmployeeName");
var empPosition=document.querySelector("#EmployeePosition");
var empEmail=document.querySelector("#Email");
var supID=document.querySelector("#supervisor");

var empIDFormat = /^[0-9a-zA-Z]+$/;
var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

var employeeList=[];

eForm.addEventListener('submit', (event) => {
    validateEmployeeForm();
    if (isFormValid(eForm) == true) {
        var employee = {
            deptID: DeptID.value,
            EmpID: empID.value,
            name: empName.value,
            position: empPosition.value,
            email: empEmail.value,
            SupID: supID.value,
            SupName: supName.value
        };
        employeeList.push(employee);
        alert("Employee name: " + employee.name + " with an ID of " + employee.EmpID + " has been registered!");
    }
    else {
        event.preventDefault();
    }
});

function validateEmployeeForm() {
    if (DeptID && DeptID.value.trim() =="") {
        setError(DeptID, "Please select a department ID!");
    }
    else {
        setSuccess(DeptID);
    }

    if (empID && empID.value.trim() == "") {
        setError(empID, "Please fill in the employee ID!");
    }
    else if (empID && validateFormat(empID.value, empIDFormat)) {
        setSuccess(empID);
    }
    else if (empID) {
        setError(empID, "Please follow the employee ID format...");
    }

    if (empName && empName.value.trim() == "") {
        setError(empName, "Please fill in the employee name!");
    }
    else {
        setSuccess(empName);
    }
    
    if (empPosition && empPosition.value.trim() == "") {
        setError(empPosition, "Please fill in the employee position!");
    }
    else {
        setSuccess(empPosition);
    }

    if (empEmail && empEmail.value.trim() == "") {
        setError(empEmail, "Please fill in the email!");
    }
    else if (empEmail && validateFormat(empEmail.value, emailFormat)) {
        setSuccess(empEmail);
    }
    else if (empEmail) {
        setError(empEmail, "Email format is invalid.");
    }
}

function setError(element, errorMessage) {
    const parent = element.parentElement;
    if (parent.classList.contains('success')) {
        parent.classList.remove('success');
    }
    parent.classList.add('error');
    const paragraph = parent.querySelector('p');
    paragraph.textContent = errorMessage;
}

function setSuccess(element) {
    const parent = element.parentElement;
    if (parent.classList.contains('error')) {
        parent.classList.remove('error');
    }
    parent.classList.add('success');
}

function validateFormat(input, inputFormat) {
    return inputFormat.test(input);
}

function isFormValid(form) {
    const inputContainers = form.querySelectorAll('.input-control');
    let result = true;
    inputContainers.forEach((container) => {
        if (container.classList.contains('error')) {
            result = false;
        }
    });
    return result;
}