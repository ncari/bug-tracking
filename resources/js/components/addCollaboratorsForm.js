import React, {useState} from 'react';
import ReactDOM from 'react-dom';


const AddCollaboratorsForm = (props) => {
    const [users, setUsers] = useState(props.users);
    const [value, setValue] = useState('');
    const [usersSelected, setUsersSelected] = useState([]);

    const add = (id) => {
        const newList = [...usersSelected];
        newList.push(users.find(user => user.id === id));
        setUsersSelected(newList);
        
        const newUsers = users.filter(user => user.id !== id);
        setUsers(newUsers);
    }
 
    const remove = (id) => {
        const newList = [...usersSelected].filter(user => user.id !== id);
        setUsersSelected(newList);

        let newUsers = [...users];
        newUsers.push(usersSelected.find(user => user.id === id));
        setUsers(newUsers);
    }

    return (  
        <>
            <input value={value} onChange={(e) => setValue(e.target.value)} className="form-control" placeholder="Search users"/>
            <div>
                {value !== '' && users.map(user => {
                    if(user.name.toLowerCase().startsWith(value.toLowerCase()))
                        return (
                            <button
                                key={user.id}
                                type="button" 
                                className="btn btn-sm btn-outline-success m-1"
                                onClick={() => add(user.id)}
                            >
                                {`${user.name} +`}
                            </button>
                        );
                    else
                        return null;
                })}
            </div>
            <div className="mt-2 d-flex">
                {usersSelected.map((user) => 
                    <div key={user.id}>
                        <input type="hidden" value={user.id} name="users[]"/>
                        <button
                            type="button" 
                            className="btn btn-sm btn-outline-primary m-1"
                            onClick={() => remove(user.id)}
                        >
                            {`${user.name} X`}
                        </button>
                    </div>
                )}
            </div>
        </>
    );
}
 
export default AddCollaboratorsForm;


if(document.getElementById("addCollaboratorsForm")){
    let users = JSON.parse(document.getElementById('users').value);
    ReactDOM.render(<AddCollaboratorsForm users={users} />, document.getElementById("addCollaboratorsForm"));
}