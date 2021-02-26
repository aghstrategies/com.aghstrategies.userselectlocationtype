# com.aghstrategies.userselectlocationtype

This extension adds an option when configuring a profile: "Address Location Type". When this field is included on a profile any Address fields with the Location type of "Primary" will be saved based on the location type the user selects in the  "Address Location Type" field.

## Configuration
### Address Location Type Field
When Setting up a profile include:
1. a "Address Location Type" field (under Contacts)
2. Address fields with the Location type "Primary"

![Settings](/images/addressLocationTypeField.png)

### Email Location Type Field
When Setting up a profile include:
1. a "Email Location Type" field (under Contacts)
2. an "Email" field with the Location type "Primary"

### Phone Location Type Field
When Setting up a profile include:
1. a "Phone Location Type" field (under Contacts)
2. an "Phone" field with the Location type "Primary" and the type "Phone"

## Usage
When using a profile that has been configured as described in the Configuration section (as a stand alone form, on a contribution form or on a event registration form)

The location type the user selects for the "Address Location Type" field will dictate the location type of the address entered.

The Location type the user selects for the "Email Location Type" field will dictate the location type of the email address.

See tests folder for more details.

![Front End UI](/images/profile.png)

## Future Feature Ideas
1. Add location type fields for all phone types (right now only phone - phone exists)
2. Add a settings for which location types should be available either to the location types themselves or when configuring the location type fields on the profile.
3. Add a setting so the user can decide whether or not the email or address should be saved as primary (currently follows civi logic to determine the primary)
