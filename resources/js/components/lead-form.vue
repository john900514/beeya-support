<template>
    <div class="lead-section">
        <div id="contactForm">
            <div id="fnRow" class="c-form-elem">
                <input type="text"  name="formFName" placeholder="First Name" v-model="fname">
            </div>

            <div id="lnRow" class="c-form-elem">
                <input type="text"  name="formLName" placeholder="Last Name" v-model="lname">
            </div>

            <div id="emRow" class="c-form-elem">
                <input type="text"  name="formEmail" placeholder="Email Address" v-model="email">
            </div>

            <div id="moRow" class="c-form-elem">
                <input type="text"  name="formMobile" placeholder="Mobile" v-model="mobile">
            </div>
        </div>

        <div class="control-panel">
            <div id="checkerBox">
                <input type="checkbox" name="optIn" value="true" id="checkboxOptin" v-model="consent"/>
                <label for="optIn">
                    <small>I hereby consent to receive phone, text and email messages from or on behalf of BEEYA.COM, INC at the telephone number and email provided. I understand that consent is not a condition of purchase.</small>
                </label>
            </div>

            <button type="button" class="send-button" @click="validateAndSubmit()">
                <i class="fal fa-mailbox"></i>
                <span>SIGN ME UP!</span>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "lead-form",
        props: ['sessionid'],
        data() {
            return {
                fname: '',
                lname: '',
                email: '',
                mobile: '',
                consent: false
            };
        },
        methods: {
            validateAndSubmit: function validateAndSubmit() {
                let result = true;

                if(result === true && this.fname === '') {
                    result = false;
                    alert('What is your first name?');
                }

                if(result === true && this.lname === '') {
                    result = false;
                    alert('What is your your last name?');
                }

                if(result === true && this.validEmail() !== true) {
                    result = false;
                    alert('What is your  email address?');
                }

                if(result === true && this.validMobile() !== true) {
                    result = false;
                    alert('What is your mobile phone #?');
                }

                if(result === true && this.consent !== true) {
                    result = false;
                    alert('Check the consent box to let us know you want to hear from us!');
                }

                if(result === true) {
                    this.fireContactRequest();
                }
            },
            fireContactRequest: function fireContactRequest() {
                let _this = this;
                this.$parent.loading = false;

                $.ajax({
                    url: '/api/leads',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    data: {
                        fname: _this.fname,
                        lname: _this.lname,
                        email: _this.email,
                        mobile: _this.mobile,
                        game_id: _this.sessionid,
                    },
                    success: function (data) {
                        if ('success' in data) {
                            if (data['success'] === true) {
                                alert('Thanks, ' + data['lead']['fname'] + '! Be on the lookout for emails from us!');
                                _this.$parent.loading = false;
                            } else {
                                alert(data['reason'] + 'Wanna try again?');
                                _this.$parent.loading = false;
                            }
                        } else {
                            alert('Server returned unreadable response. Be sure you have a good connection and try again?');
                            _this.$parent.loading = false;
                        }
                    },
                    error: function (e) {
                        alert('Could not save your information. Please try again?');
                        console.log(e);
                        _this.$parent.loading = false;
                    }
                });
            },
            validEmail: function validEmail() {
                let results = false;

                if (this.email !== '') {
                    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    results = re.test(String(this.email).toLowerCase());
                }

                return results;
            },
            validMobile: function validMobile() {
                let results = false;

                if (this.mobile !== '') {
                    let ph = libphonenumber.parsePhoneNumberFromString(this.mobile, 'US');

                    if(ph !== undefined) {
                        if(libphonenumber.isValidNumber(ph.number))
                        {
                            results = true;
                        }

                    }
                }

                return results;
            }
        },
        mounted: function () {
            console.log('Leads Form section loaded.')
        }
    }
</script>

<style scoped>
    .lead-section > div {
        margin: 1em 1%;
    }

    #checkerBox {
        margin: 1em 15%;
        max-width: 70%;
        width: 100%;
        display: flex;
        flex-flow: row;
        justify-content: center;
        align-items: center;
    }

    #checkboxOptin {
        transform: scale(2);
        margin-right: 1em;
    }

    .c-form-elem {
        margin: 1em 0;
        width: 100%;
    }

    .c-form-elem > input {
        height: 3em;
        font-size: 1.1em;
        border: 3px solid gray;
        border-radius: 0.25em;
    }

    .send-button {
        width: 10em;
        background-color: #EE7229;
        height: 2.5em;
        border-radius: 0.5em;
        color: #fff;
        font-size: 1.25em;
    }

    .send-button:hover {
        background-color: coral;
    }

    @media screen and (max-width: 999px) {

        .c-form-elem > input {
            width: 90%;
            padding-left: 1em;
        }
    }

    @media screen and (min-width: 1000px) {
        .c-form-elem > input {
            max-width: 70%;
            width: 100%;
            padding: 0 1em;
        }
    }
</style>
