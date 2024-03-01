<!DOCTYPE html>
<html lang="en-us" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PulseContact • Home</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body id="home-page">
<script defer type="module">
    //   function reloadContacts() {
    //     const contactListContainer = document.querySelector('.contact-list-sec');
    //     fetch('../data/usr_data.json')
    //         .then(response => response.json())
    //         .then(contacts => {
    //             const contactsHTML = contacts.map(contact => `<p>${contact.name} ${contact.surname}</p>`).join('');
    //             contactListContainer.innerHTML = contactsHTML;
    //         })
    //         .catch(error => console.error('Failed to load contact json files :', error));
    // }
    const hidePopup = () => {
      console.info("What's new");
    }
  </script>
  <?php 
     $USR_DATA_BDD_PATH = "../data/usr_data.json";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['contact-surname']) && isset($_POST['contact-name']) && isset($_POST['contact-email']) && isset($_POST['contact-phone']) && isset($_POST['contact-birth'])) {
        $surname = $_POST['contact-surname'];
        $name = $_POST["contact-name"];
        $email = $_POST['contact-email'];
        $phone = $_POST['contact-phone'];
        $birth = $_POST['contact-birth'];

        // Checking value : unmandatory for now ...
        $countrieCMPaterm = "/^(\+237|00237|0)(6|2|5|4|3|7|8|9)([0-9 ]{8,})$/";
        if (!(preg_match($countrieCMPaterm, $phone))) {
          print "
            <p class='form-state-msg' style='width: 100%; background-color: red'>Wrong Phone Number Format -> $phone</p>
            <script>
                setTimeout(() => {
                  document.querySelector('p.form-state-msg').style.display = 'none';
                }, 3500);
                </script>
          ";
        } else {
          // Read existing JSON Contact Values
          $jsonStrings = file_get_contents($USR_DATA_BDD_PATH);
          $contacts = json_decode($jsonStrings, true);

          // Save New Contact On Existings List Contacts
          $newContact = array(
            "surname" => $surname,
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "birth:" => $birth
          );
          $contacts[] = $newContact; // Object ready.

          // Updates usr_data.json (fake BDD) with up to date data.
          file_put_contents($USR_DATA_BDD_PATH, json_encode($contacts));
          print "<p class='form-state-msg' style='width: 100%; background-color: hsl(166, 21%, 77%)';>Contact Saved</p>";
          print "<script>
                setTimeout(() => {
                  document.querySelector('p.form-state-msg').style.display = 'none';
                }, 3500);
                </script>";
        }
      } else print "
        <p class='form-state-msg' style='width: 100%; background-color: red'>Error Occurend, Please fill all fields</p>
        <script>
                setTimeout(() => {
                  document.querySelector('p.form-state-msg').style.display = 'none';
                }, 3500);
                </script>
      ";
    }
  ?>
  <header id="app-home-header" class="flex">
    <div class="flex">
      <strong>PulseContact</strong>
      <span>Leads List</span>
    </div>
    <nav class="flex">
      <div class="search-box flex">
        <input type="text" name="search-contact" id="search-contact" placeholder="Search">
        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512" height="512">
          <path
            d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z" />
        </svg>
      </div>
      <a href="../pdf_export.php" download="contacts.pdf" title="Export as Pdf File">
        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512"><path d="M19.95,5.54l-3.49-3.49c-1.32-1.32-3.08-2.05-4.95-2.05H7C4.24,0,2,2.24,2,5v14c0,2.76,2.24,5,5,5h10c2.76,0,5-2.24,5-5V10.49c0-1.87-.73-3.63-2.05-4.95Zm-1.41,1.41c.32,.32,.59,.67,.81,1.05h-4.34c-.55,0-1-.45-1-1V2.66c.38,.22,.73,.49,1.05,.81l3.49,3.49Zm1.46,12.05c0,1.65-1.35,3-3,3H7c-1.65,0-3-1.35-3-3V5c0-1.65,1.35-3,3-3h4.51c.16,0,.33,0,.49,.02V7c0,1.65,1.35,3,3,3h4.98c.02,.16,.02,.32,.02,.49v8.51ZM7.09,13h-1.09c-.55,0-1,.45-1,1v4.44c0,.35,.28,.62,.62,.62s.62-.28,.62-.62v-1.22h.84c1.18,0,2.14-.95,2.14-2.11s-.96-2.11-2.14-2.11Zm0,2.97h-.83s0-1.72,0-1.72h.84c.48,0,.89,.39,.89,.86s-.41,.86-.89,.86Zm11.93-2.34c0,.35-.28,.62-.62,.62h-1.69v1.14h1.24c.35,0,.62,.28,.62,.62s-.28,.62-.62,.62h-1.24v1.8c0,.35-.28,.62-.62,.62s-.62-.28-.62-.62v-4.81c0-.35,.28-.62,.62-.62h2.31c.35,0,.62,.28,.62,.62Zm-6.93-.62h-1.09c-.55,0-1,.45-1,1v4.44c0,.35,.28,.56,.62,.56s1.46,0,1.46,0c1.18,0,2.14-.95,2.14-2.11v-1.78c0-1.16-.96-2.11-2.14-2.11Zm.89,3.89c0,.47-.41,.86-.89,.86h-.83s0-3.5,0-3.5h.84c.48,0,.89,.39,.89,.86v1.78Z"/></svg>
      </a>
      <a href="../vcf_export.php" download="contacts.vcf" title="Export You Contact As VCF File">
      <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512"><path d="M18.66,20.9c-.41-.37-1.05-.33-1.41,.09-.57,.65-1.39,1.02-2.25,1.02H5c-1.65,0-3-1.35-3-3V5c0-1.65,1.35-3,3-3h4.51c.16,0,.33,0,.49,.02V7c0,1.65,1.35,3,3,3h5.81c.31,0,.6-.14,.79-.39s.25-.56,.18-.86c-.31-1.22-.94-2.33-1.83-3.22l-3.48-3.48c-1.32-1.32-3.08-2.05-4.95-2.05H5C2.24,0,0,2.24,0,5v14c0,2.76,2.24,5,5,5H15c1.43,0,2.8-.62,3.75-1.69,.37-.41,.33-1.05-.09-1.41ZM12,2.66c.38,.22,.73,.49,1.05,.81l3.48,3.48c.31,.31,.58,.67,.8,1.05h-4.34c-.55,0-1-.45-1-1V2.66Zm11.13,15.43l-1.61,1.61c-.2,.2-.45,.29-.71,.29s-.51-.1-.71-.29c-.39-.39-.39-1.02,0-1.41l1.29-1.29h-7.4c-.55,0-1-.45-1-1s.45-1,1-1h7.4l-1.29-1.29c-.39-.39-.39-1.02,0-1.41s1.02-.39,1.41,0l1.61,1.61c1.15,1.15,1.15,3.03,0,4.19Z"/></svg>
      </a>
      <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512" height="512">
        <path
          d="M22.555,13.662l-1.9-6.836A9.321,9.321,0,0,0,2.576,7.3L1.105,13.915A5,5,0,0,0,5.986,20H7.1a5,5,0,0,0,9.8,0h.838a5,5,0,0,0,4.818-6.338ZM12,22a3,3,0,0,1-2.816-2h5.632A3,3,0,0,1,12,22Zm8.126-5.185A2.977,2.977,0,0,1,17.737,18H5.986a3,3,0,0,1-2.928-3.651l1.47-6.616a7.321,7.321,0,0,1,14.2-.372l1.9,6.836A2.977,2.977,0,0,1,20.126,16.815Z" />
      </svg>
      <div class="profile"></div>
    </nav>
  </header>
  <main id="app-home-content">
    <div class="flex">
      <h2>Click to add contect</h2>
      <span>Get started to add new contact on your system.</span>
      <p id="add-contact-btn">+ Add Contact</p>
    </div>
    <div class="contact-list-sec flex"></div>
    <div class="details-contact-review flex"></div>
  </main>
  <div class="modal" id="add-contact-modal">
    <div class="modal-content">
      <form id="add-contact-form" method="POST">
        <h2>Fill Contact Information</h2>
        <div class="fields">
          <div>
            <label for="contact-surname">Surname</label>
            <input type="text" placeholder="Contact Surname" id="contact-surname" name="contact-surname">
          </div>
          <div>
            <label for="contact-name">Name</label>
            <input type="text" required placeholder="Contact Nname" id="contact-name" name="contact-name">
          </div>
          <div>
            <label for="contact-email">Contact Email</label>
            <input type="email" placeholder="Contact Email" id="contact-enail" name="contact-email">
          </div>
          <div>
            <label for="contact-email">Phone Number</label>
            <input type="phone" required placeholder="+237 xxx xxx xxx" id="contact-phone" name="contact-phone">
          </div>
          <div>
            <label for="contact-email">Birthday</label>
            <input type="date" id="contact-bith" name="contact-birth">
          </div>
        </div>

        <button type="submit" id="add-contact-form-btn">Save Contact</button>
      </form>
      <span id="close-modal-btn">&times;</span>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const AddContactModalBtn = document.getElementById("add-contact-btn");
    const AddContactFormBtn = document.getElementById("add-contact-form-btn");
    const AdddContactModal = document.getElementById("add-contact-modal");
    const CloseContactModalBtn = document.getElementById("close-modal-btn");
    const ContactListSection = document.querySelector('.contact-list-sec');
    const ContactDetailSection = document.querySelector(".details-contact-review");

    const openModal = () => {
      AdddContactModal.style.display = "block";
    }

    const closeModal = () => {
      AdddContactModal.style.display = "none";
    }

    AddContactModalBtn.onclick = () => openModal();
    CloseContactModalBtn.onclick = () => closeModal();

    AddContactFormBtn.onsubmit = (event) => {
      event.preventDefault();
      // Logic's
      closeModal();
    }

    // const deleteContact = async (Contact) => {
    //   for (i = 0; i < ContactItems.lenght; ++i) {
    //     ContactItems.remove(Contact);
    //   }
    // }

    const showDetailsContact = (Contact) => {
      const ContactItems = document.querySelectorAll(".contact-item");
      ContactItems.forEach((ContactItem) => ContactItem.classList.remove("selected"));

      const SelectedContactItem = Array.from(ContactItems).find(item => {
        const [surname, name] = item.textContent.split(' ');
        return Contact.surname === surname && Contact.name === name;
      });

      if (SelectedContactItem) SelectedContactItem.classList.add("selected");

      Contact ? ContactDetailSection.innerHTML = `
          <div class="contact-view">
            <div class="contact-view__profile"></div>
            <div class="contact-view__content">
              <div class="contact-review">
              <p>Name:&nbsp;&nbsp;&nbsp;&nbsp;<span contenteditable="true">${Contact.name} ${Contact.surname}</span></p>
              <p>Email:&nbsp;&nbsp;&nbsp;&nbsp;<span contenteditable="true">${Contact.email}</span></p>
              <p>Phone:&nbsp;&nbsp;&nbsp;&nbsp;<span contenteditable="true">${Contact.phone}</span></p>
              <p>BirthDay:&nbsp;&nbsp;&nbsp;&nbsp;<span contenteditable="true">🎂🎊 ${Contact.birth} 🎉🍾</span></p>
              <i>
              </div>
              <svg width="800px" height="800px" viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" title="Delete This Contact">
                <title>delete [#1487]</title>
                <desc>Created with Sketch.</desc>
                <defs>
                </defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="#ff0000" fill-rule="evenodd">
                        <g id="Dribbble-Light-Preview" transform="translate(-179.000000, -360.000000)" fill="#000000">
                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                <path d="M130.35,216 L132.45,216 L132.45,208 L130.35,208 L130.35,216 Z M134.55,216 L136.65,216 L136.65,208 L134.55,208 L134.55,216 Z M128.25,218 L138.75,218 L138.75,206 L128.25,206 L128.25,218 Z M130.35,204 L136.65,204 L136.65,202 L130.35,202 L130.35,204 Z M138.75,204 L138.75,200 L128.25,200 L128.25,204 L123,204 L123,206 L126.15,206 L126.15,220 L140.85,220 L140.85,206 L144,206 L144,204 L138.75,204 Z" id="delete-[#1487]">
                </path>
                        </g>
                    </g>
                </g>
              </svg>
              </i>
            </div>
          </div>
        ` : `
        <h2>Contact details</h2>
          <p>👈🏾Please select contact to see detail&apos;s here</p>
        `;
    }

    const updateContactList = async () => {
      try {
        const response = await fetch("../data/usr_data.json");
        const contacts = await response.json();

        ContactListSection.innerHTML = "";
        contacts.forEach(Contact => {

          const ContactItem = document.createElement("div");
          ContactItem.setAttribute("class", "contact-item flex");

          const ContactItemContent = document.createElement("div");
          ContactItemContent.setAttribute("class", "contact-item-content flex");

          ContactItemContent.innerHTML = `
          <div class="profile"></div>
          <div class="contact-review">
            <h3>${Contact.surname} ${Contact.name}</h3>
            <a href="mailto:${Contact.email}">${Contact.email}</a>
            <p>${Contact.phone}</p>
          </div>
          `;
          ContactItem.appendChild(ContactItemContent);
          ContactItem.onclick = () => showDetailsContact(Contact);

          ContactListSection.appendChild(ContactItem);
          // console.info("Contact Widgets Has Been Appended");
        });
      } catch (reason) {
        console.error("Error to fetching contacts: ", reason);
      }
    }

    updateContactList();

    
    const ContactView = document.querySelector(".contact-view");
    console.log(ContactView);
  });
</script>

</html>