
// saerch bar
const Search = () => (
    <form action="/" method="get">
        <label htmlFor="header-search">
            <span className="visually-hidden">Search Nobel Laureate</span>
        </label>
        <input
            type="text"
            id="header-search"
            placeholder="Search Nobel Laureate"
            name="s" 
        />
        <button type="submit">Search</button>
    </form>
);

export default Search;


// test data
const posts = [
    { id: '1', name: 'This first post is about React' },
    { id: '2', name: 'This next post is about Preact' },
    { id: '3', name: 'We have yet another React post!' },
    { id: '4', name: 'This is the fourth and final post' },
];

const App = () => {
    return (
        <div>
            <Search />
            <ul>
                {posts.map((post) => (
                    <li key={post.id}>{post.name}</li>
                ))}
            </ul>
        </div>
    );
}



