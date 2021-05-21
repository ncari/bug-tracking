import React, {useState} from 'react';
import ReactDOM from 'react-dom';


const RemoveCollaboratorsForm = (props) => {
    const [collaborators, setCollaborators] = useState(props.collaborators);
    const [value, setValue] = useState('');
    const [collaboratorsSelected, setCollaboratorsSellected] = useState([]);

    const add = (id) => {
        const newList = [...collaboratorsSelected];
        newList.push(collaborators.find(collaborator => collaborator.id === id));
        setCollaboratorsSellected(newList);
        
        const newCollaborators = collaborators.filter(collaborator => collaborator.id !== id);
        setCollaborators(newCollaborators);
    }
 
    const remove = (id) => {
        const newList = [...collaboratorsSelected].filter(collaborator => collaborator.id !== id);
        setCollaboratorsSellected(newList);

        let newCollaborators = [...collaborators];
        newCollaborators.push(collaboratorsSelected.find(collaborator => collaborator.id === id));
        setCollaborators(newUsers);
    }

    return (  
        <>
            <input value={value} onChange={(e) => setValue(e.target.value)} className="form-control" placeholder="Search users"/>
            <div>
                {collaborators.map(collaborator => {
                    return (
                        <button
                            key={collaborator.id}
                            type="button" 
                            className="btn btn-sm btn-outline-success m-1"
                            onClick={() => add(collaborator.id)}
                        >
                            {`${collaborator.name} X`}
                        </button>
                    );
                })}
            </div>
            <div className="mt-2">
                {collaboratorsSelected.map((collaborator) => 
                    <>
                        <input type="hidden" value={collaborator.id} name="users[]"/>
                        <button
                            key={collaborator.id} 
                            type="button" 
                            className="btn btn-sm btn-outline-primary m-1"
                            onClick={() => remove(collaborator.id)}
                        >
                            {`${collaborator.name} +`}
                        </button>
                    </>
                )}
            </div>
        </>
    );
}
 
export default RemoveCollaboratorsForm;


if(document.getElementById("removeCollaboratorsForm")){
    let collaborators = JSON.parse(document.getElementById('collaborators').value);
    ReactDOM.render(<RemoveCollaboratorsForm collaborators={collaborators} />, document.getElementById("removeCollaboratorsForm"));
}