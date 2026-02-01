document.addEventListener("DOMContentLoaded", () => {

    const expertiseSelect = document.getElementById("expertise");
    const otherFields = document.getElementById("other-fields");
    const selectedList = document.getElementById("selected-list");
    const hiddenExpertise = document.getElementById("hiddenExpertise");

    let expertiseArray = [];

    // Add expertise to list
    expertiseSelect.addEventListener("change", () => {
        let value = expertiseSelect.value;

        if (value === "Others") {

            otherFields.innerHTML = `
                <label>Enter Custom Expertise:</label>
                <input type="text" id="customExpertise" placeholder="Type expertise">
                <button type="button" id="addCustomBtn">Add</button>
            `;

            document.getElementById("addCustomBtn").onclick = () => {
                let custom = document.getElementById("customExpertise").value.trim();
                if (custom !== "" && !expertiseArray.includes(custom)) {
                    expertiseArray.push(custom);
                    updateList();
                }
            };

        } else {
            if (!expertiseArray.includes(value)) {
                expertiseArray.push(value);
                updateList();
            }
            otherFields.innerHTML = "";
        }
    });

    // Update the top display list
    function updateList() {
        selectedList.innerHTML = "";
        expertiseArray.forEach((exp, i) => {
            let tag = document.createElement("span");
            tag.innerHTML = exp + " ×";
            tag.onclick = () => {
                expertiseArray.splice(i, 1);
                updateList();
            };
            selectedList.appendChild(tag);
        });

        hiddenExpertise.value = JSON.stringify(expertiseArray);
    }
});
