SCENARIO: User is submitting a profile form with an Location type field

FEATURE User updates Address Location Type

WHEN a user is on a profile form in edit mode
AND that profile has a "Address Location Type" field
AND that profile has a "City" field for which the location type is set as "Primary"
AND the user enters "Main" as the Address Location Type
AND the user enters "City" as "Nashville"
THEN The users primary address will be saved as "location type"="Main", City="Nashville"

FEATURE User updates Email Location Type

WHEN a user is on a profile form in edit mode
AND that profile has a "Email Location Type" field
AND that profile has a "email" field for which the location type is set as "Primary"
AND the user enters "Main" as the email Location Type
AND the user enters "email" as "example@ex.com"
THEN The users primary email address will be saved as example@ex.com "location type"="Main"
