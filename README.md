# com.aghstrategies.userselectlocationtype

This extension adds an option when configuring a profile: "Address Location Type". When this field is included on a profile any Address fields with the Location type of "Primary" will be saved based on the location type the user selects in the  "Address Location Type" field.

## Configuration
When Setting up a profile include:
1. a "Address Location Type" field
2. Address fields with the Location type "Primary"

![Settings](/images/addressLocationTypeField.png)

## Usage
When using a profile that has been configured as described in the Configuration section (as a stand alone form, on a contribution form or on a event registration form) the location type the user selects for the "Address Location Type" field will dictate the location type of the Primary address. See tests folder for more details.

![Front End UI](/images/profile.png)

## Future Feature Ideas
1. Add "Email location type" field for Email Address
2. Add location type Fields for phone (this will be a little more complicated because of the phone types (Fax, Mobile etc.)
3. Add settings for:
  - Which location types should be available
  - Whether the address should be saved as primary (currently they all are)
